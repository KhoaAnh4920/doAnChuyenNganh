<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use App\CategoryProduct;
use App\Brand;
use App\Product;
use App\GalleryImage;
use View;
use Alert;
use Auth;
use App\User;
use App\Admin;
use App\Slider;
session_start();

class ProductController extends Controller
{

    // Đổi tên data2, chưa checkimg hình, 

    // Frontend //
    // public function product(){
    //     return view('frontend.pages.productsPages.product');
    // }

    // Kiểm tra hình có hợp lệ //
    public function checkimg($h){
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
        // Dung lượng hình tối đa là 2MB
        $maxsize = 2 * 1024 * 1024;
        $file_name = $h->getClientOriginalName(); // Lấy tên hình //
        $file_size = $h->getSize(); // Lấy dung lượng hình //
        
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); // Lấy đuôi hình //

        // Check đuôi mở rộng hình có hợp lệ hay không //
        if(in_array(strtolower($file_ext), $allowed_types)) {
            // Check dung lượng hình - 2MB max
            if ($file_size > $maxsize) {
                //Alert::error('Dung lượng ảnh quá lớn');
                var_dump($file_size); exit;
                return -1;
            }
        }
        else{
            //Alert::error('Ảnh không hợp lệ');
            return 0;
        }
        return 1;
    }

    // Trang hiển thị chi tiết sản phẩm //
    public function productDetails($pro_slug){
        
        // Lấy mã sản phẩm dựa vào slug //
        $pro_id = Product::select('maSanPham')->where('slug', $pro_slug)->get();

        foreach($pro_id as $key => $id){
            $pro_by_id = $id->maSanPham;
        }
        // Lấy thông tin sản phẩm //
        $detail_pro = Product::join("danhmucsanpham", function($join){
            $join->on("danhmucsanpham.maDanhMuc", "=", "dbsanpham.maDanhMuc");
        })
        ->join("thuonghieu", function($join){
            $join->on("thuonghieu.mathuonghieu", "=", "dbsanpham.maThuongHieu");
        })
        ->select("dbsanpham.*", "danhmucsanpham.tendanhmuc", "thuonghieu.tenthuonghieu")
        ->where("dbsanpham.masanpham", $pro_by_id)
        ->get();
        // Lấy danh mục hình ảnh của sản phẩm //
        $gallery_pro = DB::table("danhmuchinh")->where('maSanPham', $pro_by_id)->get();

        foreach($detail_pro as $key => $val){
            $cate = $val->maDanhMuc;
        }


        // Lấy sản phẩm liên quan có cùng danh mục //
        $recommmendedProducts = Product::where('maDanhMuc', $cate)->limit(6)->get();
        return view('frontend.pages.productsPages.productDetails')->with('detail_pro', $detail_pro)
        ->with('recommmendedProducts', $recommmendedProducts)
        ->with('gallery_pro', $gallery_pro);
    }

    
    // Backend //

    public function checkLogin(){
        // Check người dùng đã đăng nhập chưa //
        $isLogin = Auth::guard('admin')->check();
        // Nếu isLogin khác true - chưa đăng nhập, return về trang đăng nhập //
        if(!$isLogin)
            return Redirect::to('/admin-login.html')->send();
    }
    // Trang liệt kê sản phẩm //
    public function lietKeSanPham(){
        $this->checkLogin();

        Session::forget('gal_del');
        $all_products = Product::join('danhmucsanpham', 'danhmucsanpham.maDanhMuc', '=', 'dbsanpham.maDanhMuc')
        ->join('thuonghieu', 'thuonghieu.maThuongHieu', '=', 'dbsanpham.maThuongHieu')
        ->select("dbsanpham.*", "danhmucsanpham.tendanhmuc", "thuonghieu.tenthuonghieu")
        ->orderBy('dbsanpham.maSanPham', 'DESC')
        ->paginate(10);
    
        return view('backend.pages.sanPham.lietKeSanPham')->with('all_products', $all_products);
    }
    // Trang thêm sản phẩm //
    public function themSanPham(){
        $this->checkLogin();
        // Lấy thương hiệu //
        $all_brands = Brand::orderby('maThuongHieu')->get();
        // Lấy danh mục sản phẩm //
        $all_category_products = CategoryProduct::orderby('maDanhMuc')->get();

        return view('backend.pages.sanPham.themSanPham')->with('all_brands', $all_brands)->with('all_category_products', $all_category_products);
    }
    // Trang cập nhật sản phẩm //
    public function suaSanPham($pro_id){
        $this->checkLogin();

        $all_brands = Brand::orderby('maThuongHieu')->get();
        $all_category_products = CategoryProduct::orderby('maDanhMuc')->get();
        $edit_pro = Product::where('maSanPham', $pro_id)->get();

        // Lấy danh mục hình của sản phẩm //
        $cate_image = GalleryImage::where('maSanPham', $pro_id)->get();

        //var_dump($cate_image); exit;
        return view('backend.pages.sanPham.suaSanPham')->with('edit_pro', $edit_pro)->with('all_category_products', $all_category_products)
        ->with('all_brands', $all_brands)->with('cate_image', $cate_image);
    }
    // Xử lý thêm sản phẩm //
    public function createProduct(Request $request){
        $this->checkLogin();
        $data = array();
        $dataHinh = array();

        // Tạo đối tượng product //
        $product = new Product();
        // Gán các value từ request vào product //
        $product->tenSanPham = $request->tenSanPham;
        $product->slug = $request->slug_sanpham;
        $product->giaSanPham = $request->giaSanPham;
        $product->moTaSanPham = $request->moTaSanPham;
        $product->maDanhMuc = $request->danhMucSanPham;
        $product->maThuongHieu = $request->thuongHieu;
        $product->trangThai = $request->trangThai;

        // Lấy hình ảnh //
        $get_image = $request->file('hinhAnh');
        // Danh mục hình // 
        $gallery_image = $request->file('file');

        if($get_image){
            $result = $this->checkimg($get_image); // Kiểm tra ảnh có hợp lệ không //
            if($result == -1){
                Alert::error('Dung lượng ảnh quá lớn');
                return redirect()->back();
            }
            else if($result == 0){
                Alert::error('Ảnh không hợp lệ');
                return redirect()->back();
            }
            else{
                $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
                $file_name = pathinfo($get_name_image, PATHINFO_FILENAME); // tách tên file bỏ đuôi mở rộng //
                $get_name_image = $file_name . '_'.time(). '.'. $get_image->getClientOriginalExtension(); // Gán tên file + thời gian hiện tại //
                $get_image->move('public/upload/products', $get_name_image); // Di chuyển file vào thư mục public //
                $product->hinhAnh = $get_name_image;
            }
        }else{
            Alert::error('Vui lòng chọn ảnh cho sản phẩm');
            return redirect()->back();
        }
        // insert sản phẩm vào db //
        $n =$product->save();
        
        if($n <=0){
            Alert::error('Lỗi thêm sản phẩm');
            return redirect()->back();
        }
        // Lấy mã sản phẩm vừa mới thêm vào db //
        $pro_id = Product::select('maSanPham')->orderBy('maSanPham', 'DESC')->first();

        // Nếu người dùng có thêm danh mục hình // 
        $dem = 0;
        if($gallery_image){
            foreach($gallery_image as $image){ // Duyệt từng hình ảnh trong danh mục hình //
                $result = $this->checkimg($image); // Kiểm tra ảnh có hợp lệ không //
                if($result){
                    $get_name_image = $image->getClientOriginalName(); // Lấy tên file
                    $file_name = pathinfo($get_name_image, PATHINFO_FILENAME); // tách tên file bỏ đuôi mở rộng //
                    $get_name_image = $file_name . '_'.time(). '.'. $get_image->getClientOriginalExtension(); // Gán tên file + thời gian hiện tại //
                    $image->move('public/upload/gallery', $get_name_image); // Di chuyển vào public //
                    $gallImg = new GalleryImage();
                    $gallImg->maSanPham = $pro_id->maSanPham; 
                    $gallImg->hinh = $get_name_image; // Gán tên hình vào gallImg //
                    $n = $gallImg->save(); // Insert hình của sản phẩm vào db //
                    if($n <=0) // Nếu thêm thất bại - tăng biến đếm //
                        $dem++;
                }else
                    $dem++;
            }
        } // In số lượng hình ảnh bị lỗi nếu biến đếm khác 0 //
        if($dem != 0){
            Alert::error('Lỗi không thể thêm ' .$dem .' hình ảnh');
            return redirect()->back();
        }
        Alert::success('Thêm sản phẩm thành công');
        return Redirect::to('/liet-ke-san-pham.html');
    }
    // Xử lý xóa hình ảnh trong danh mục hình //
    public function deleteGallery($gal_id){
        // Duyệt từng id hình ảnh trong $gal_id //
        foreach($gal_id as $key => $img){  
            $image = GalleryImage::select('hinh')->where('maHinhSanPham', $img)->get(); // Lấy hình ảnh //
            foreach($image as $key =>$hinh){
                $h = $hinh->hinh;
            }
            // unlink hình trong thư mục public //
            unlink('public/upload/gallery/'.$h);
            // Xóa hình ảnh trong db //
            GalleryImage::where('maHinhSanPham', $img)->delete();
        }
    }

    // Xử lý cập nhật sản phẩm //
    public function updateProduct(Request $request,$pro_id){
        $this->checkLogin();
        //Session::flush();
        //Session::pull('gal_del');
        
        // Lấy ra các id của hình ảnh trong danh mục hình mà người dùng đã click xóa //
        $id_img = Session::get('gal_del');
        // Có id hình ảnh //
        if($id_img != null){
            $this->deleteGallery($id_img); // Gọi hàm deleteGallery để xóa hình ảnh trong danh mục hình
        }

        $data = array();
        $dataDanhMucHinh = array();

        // Lấy hình ảnh của sản phẩm cần cập nhật trong db //
       // $hinhAnh = Product::where('maSanPham', $pro_id)->get();

        // Tạo đối tượng product //
        $product = Product::find($pro_id);
        

        // Gán $data['hinhAnh'] mặc định = hình ảnh của sản phẩm cần cập nhật trong db
        // foreach($hinhAnh as $key => $pro){
        //     $product->hinhAnh = $pro->hinhAnh;
        // }
        
        // Gán các value từ request vào product //
        $product->tenSanPham = $request->tenSanPham;
        $product->slug = $request->slug_sanpham;
        $product->giaSanPham = $request->giaSanPham;
        $product->moTaSanPham = $request->moTaSanPham;
        $product->maDanhMuc = $request->danhMucSanPham;
        $product->maThuongHieu = $request->thuongHieu;
        $product->trangThai = $request->trangThai;

      //  $dataDanhMucHinh['maSanPham'] = $pro_id;

        $get_image = $request->file('hinhAnh');
        // Danh mục hình
        $gallery_image = $request->file('file');

        if($get_image){
            $result = $this->checkimg($get_image); // Kiểm tra ảnh có hợp lệ không //
            if($result == -1){
                Alert::error('Dung lượng ảnh quá lớn');
                return redirect()->back();
            }
            else if($result == 0){
                Alert::error('Ảnh không hợp lệ');
                return redirect()->back();
            }else{
                $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
                $file_name = pathinfo($get_name_image, PATHINFO_FILENAME); // tách tên file bỏ đuôi mở rộng //
                $get_name_image = $file_name . '_'.time(). '.'. $get_image->getClientOriginalExtension(); // Gán tên file + thời gian hiện tại //
                $get_image->move('public/upload/products', $get_name_image);
                unlink('public/upload/products/'.$product->hinhAnh);
                $product->hinhAnh = $get_name_image;
            }
           
            // var_dump($data); exit;
            // DB::table('dbsanpham')->where('maSanPham', $pro_id)->update($data);
            // Session::put('message', 'Cập nhật thành công');
            // return Redirect::to('/liet-ke-san-pham.html')->with('error_code', 5);
        }
        // Duyệt từng hình ảnh trong danh mục hình //
        $dem = 0;
        if($gallery_image){
            foreach($gallery_image as $image){
                $result = $this->checkimg($image); // Kiểm tra ảnh có hợp lệ không //
                if($result){
                    $get_name_image = $image->getClientOriginalName(); // Lấy tên file
                    $file_name = pathinfo($get_name_image, PATHINFO_FILENAME); // tách tên file bỏ đuôi mở rộng //
                    $get_name_image = $file_name . '_'.time(). '.'. $get_image->getClientOriginalExtension(); // Gán tên file + thời gian hiện tại //
                    $image->move('public/upload/gallery', $get_name_image); // Di chuyển vào public //
                    $gallImg = new GalleryImage();
                    $gallImg->maSanPham = $pro_id;
                    $gallImg->hinh = $get_name_image;
                    $n = $gallImg->save(); // Insert hình của sản phẩm vào db //
                    if($n <=0) // Nếu thêm thất bại - tăng biến đếm //
                        $dem++;
                }else
                    $dem++;
            }
        }// In số lượng hình ảnh bị lỗi nếu biến đếm khác 0 //
        if($dem != 0){
            Alert::error('Lỗi không thể thêm ' .$dem .' hình ảnh');
            return redirect()->back();
        }

        // update sản phẩm trong db //
        //$n = DB::table('dbsanpham')->where('maSanPham', $pro_id)->update($data);
        $n = $product->save();
        if($n > 0)
            Alert::success('Cập nhật thành công');
        else
            Alert::error('Cập nhật thất bại');
        return Redirect::to('/liet-ke-san-pham.html');
    }
    // Xử lý xóa sản phẩm //
    public function xoaSanPham($pro_id){
        $this->checkLogin();
        // Lấy hình ảnh của sản phẩm cần xóa trong db //
        $hinhAnh = Product::where('maSanPham', $pro_id)->get();
        foreach($hinhAnh as $key => $pro){
            $data['hinhAnh'] = $pro->hinhAnh;
        }
        // Xóa hình ảnh trong thư mục public //
        unlink('public/upload/products/'.$data['hinhAnh']);

        // Unlink danh mục hình của sản phẩm trong public //
        $dataID = GalleryImage::select("maHinhSanPham")->where("maSanPham", $pro_id)->get(); // Lấy id của hình thuộc sản phẩm //
        $idArray = array();
        foreach($dataID as $key =>$gallId){
            array_push($idArray, $gallId->maHinhSanPham); // push các id của hình vào mảng //
        }
        $this->deleteGallery($idArray); // Gọi hàm deleteGallery để unlink và xóa hình trong db //
        $n = Product::where('maSanPham', $pro_id)->delete();
        if($n)
            Alert::success('Xóa thành công');
        else
            Alert::error('Xóa thất bại');
        return Redirect::to('/liet-ke-san-pham.html');
    }
    // Put id của danh mục hình cần xóa vào session
    public function setSession(Request $request){
        //var_dump($request->gal_del); exit;

        Session::put('gal_del', $request->gal_del);
    }

    // Kết quả tìm kiếm //
    public function searchProduct(){

        // Lấy slider //
        $all_slider = Slider::where('trangThai', 1)->where('viTri',1)->orderBy('maSlider', 'DESC')->get();

        // Lấy keyword qua biến get //
        $kw = $_GET['kw'];        

        // tìm kiếm sản phẩm dựa vào tên thương hiệu, tên danh mục, tên sản phẩm, giá sản phẩm, mô tả sản phẩm, mặc định phân trang lấy 6 sản phẩm //
        $result_search = Product::join("danhmucsanpham", function($join){
            $join->on("dbsanpham.maDanhMuc", "=", "danhmucsanpham.maDanhMuc");
        })
        ->join("thuonghieu", function($join){
            $join->on("dbsanpham.maThuongHieu", "thuonghieu.maThuongHieu", "=");
        })
        ->select("dbsanpham.*", "danhmucsanpham.tendanhmuc", "thuonghieu.tenthuonghieu")
        ->where("thuonghieu.tenThuongHieu", "like", "%".$kw."%")
        ->orwhere("danhmucsanpham.tenDanhMuc", "like", "%".$kw."%")
        ->orwhere("dbsanpham.tenSanPham", "like", "%".$kw."%")
        ->orwhere("dbsanpham.giaSanPham", "like", "%".$kw."%")
        ->orwhere("dbsanpham.moTaSanPham", "like", "%".$kw."%")
        ->paginate(6);

        return view('frontend.pages.productsPages.searchPage')
        ->with('all_slider', $all_slider)
        ->with('result_search', $result_search);
    }
}