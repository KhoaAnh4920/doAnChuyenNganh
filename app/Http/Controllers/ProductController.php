<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use App\CategoryProduct;
use App\Brand;
use App\Product;
use View;
use Alert;
session_start();

class ProductController extends Controller
{

    // Đổi tên data2, chưa checkimg hình, 

    // Frontend //
    // public function product(){
    //     return view('frontend.pages.productsPages.product');
    // }

    // Trang hiển thị chi tiết sản phẩm //
    public function productDetails($pro_slug){
        // Header //
        $cate_of_Apple = CategoryProduct::whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
                        ->get();
        $cate_of_Gear = CategoryProduct::select('tenDanhMuc', 'slug')
                        ->where('danhMucCha', 14)
                        ->get();
        //var_dump($cate_of_Gear); exit;

        // end header

        
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
        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);

        // Lấy sản phẩm liên quan có cùng danh mục //
        $recommmendedProducts = Product::where('maDanhMuc', $cate)->limit(6)->get();
        return view('frontend.pages.productsPages.productDetails')->with('detail_pro', $detail_pro)
        ->with('recommmendedProducts', $recommmendedProducts)
        ->with('gallery_pro', $gallery_pro)
        ->with('cate_of_Apple', $cate_of_Apple)
        ->with('cate_of_Gear', $cate_of_Gear); 
    }

    
    // Backend //

    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
    // Trang liệt kê sản phẩm //
    public function lietKeSanPham(){
        $this->checkLogin();

        Session::forget('gal_del');
        $all_products = Product::join('danhmucsanpham', 'danhmucsanpham.maDanhMuc', '=', 'dbsanpham.maDanhMuc')
        ->join('thuonghieu', 'thuonghieu.maThuongHieu', '=', 'dbsanpham.maThuongHieu')
        ->select("dbsanpham.*", "danhmucsanpham.tendanhmuc", "thuonghieu.tenthuonghieu")
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
        $all_category_products = DB::table('danhmucsanpham')->orderby('maDanhMuc')->get();
        $edit_pro = Product::where('maSanPham', $pro_id)->get();

        // Lấy danh mục hình của sản phẩm //
        $cate_image = DB::table('danhmuchinh')->where('maSanPham', $pro_id)->get();

        //var_dump($cate_image); exit;
        return view('backend.pages.sanPham.suaSanPham')->with('edit_pro', $edit_pro)->with('all_category_products', $all_category_products)
        ->with('all_brands', $all_brands)->with('cate_image', $cate_image);
    }
    // Xử lý thêm sản phẩm //
    public function createProduct(Request $request){
        $this->checkLogin();
        $data = array();
        $data2 = array();
        // Lấy các trường value sản phẩm //
        $data['tenSanPham'] = $request->tenSanPham;
        $data['slug'] = $request->slug_sanpham;
        $data['giaSanPham'] = $request->giaSanPham;
        $data['moTaSanPham'] = $request->moTaSanPham;
        $data['maDanhMuc'] = $request->danhMucSanPham;
        $data['maThuongHieu'] = $request->thuongHieu;
        $data['trangThai'] = $request->trangThai;

        //$data2['maSanPham'] = $pro_id;

        $get_image = $request->file('hinhAnh');
        // Danh mục hình // 
        $gallery_image = $request->file('file');
        //var_dump($gallery_image); exit;

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/products', $get_name_image);
            $data['hinhAnh'] = $get_name_image;

            // DB::table('dbsanpham')->insert($data);
            // Session::put('message', 'Thêm thành công');
            // return Redirect::to('/liet-ke-san-pham.html')->with('error_code', 5);
        }
        // insert sản phẩm vào db //
        $n = DB::table('dbsanpham')->insert($data);
        if($n <=0){
            Alert::error('Lỗi thêm sản phẩm');
            return;
        }
        // Lấy mã sản phẩm vừa mới thêm vào db //
        $pro_id = DB::table('dbsanpham')->select('maSanPham')->orderBy('maSanPham', 'DESC')->first();
        $data2['maSanPham'] = $pro_id->maSanPham; // gán mã sản phẩm vào data2
        // Nếu người dùng có thêm danh mục hình // 
        if($gallery_image){
            foreach($gallery_image as $image){ // Duyệt từng hình ảnh trong danh mục hình //
                $get_name_image = $image->getClientOriginalName(); // Lấy tên file
                $image->move('public/upload/gallery', $get_name_image); // Di chuyển vào public //
                $data2['hinh'] = $get_name_image; // Gán tên hình vào mảng data2

                $n = DB::table('danhmuchinh')->insert($data2); // insert hình vào db //
                if($n <=0){
                    Alert::error('Lỗi thêm danh mục hình');
                    return;
                }
            }
        }

        Alert::success('Thêm sản phẩm thành công');
        return Redirect::to('/liet-ke-san-pham.html');
    }
    // Xử lý xóa hình ảnh trong danh mục hình //
    public function deleteGallery($gal_id){
        // Duyệt từng id hình ảnh trong $gal_id //
        foreach($gal_id as $key => $img){  
        $image = DB::table('danhmuchinh')->select('hinh')->where('maHinhSanPham', $img)->get(); // Lấy hình ảnh //
        foreach($image as $key =>$hinh){
            $h = $hinh->hinh;
        }
        // unlink hình trong thư mục public //
        unlink('public/upload/gallery/'.$h);
        // Xóa hình ảnh trong db //
        DB::table('danhmuchinh')->where('maHinhSanPham', $img)->delete();
        }
    }

    // Xử lý cập nhật sản phẩm //
    public function updateProduct(Request $request,$pro_id){
        $this->checkLogin();
        //Session::flush();
        //Session::pull('gal_del');
        
        // Lấy ra các id của hình ảnh trong danh mục hình mà người dùng đã click xóa //
        $test = Session::get('gal_del');
        // Có id hình ảnh //
        if($test != null){
            $this->deleteGallery($test); // Gọi hàm deleteGallery để xóa hình ảnh trong danh mục hình
        }
        //Session::push('gal_del', null); exit;


        
        // if($test){

        //     print_r("Có session"); exit;
        //     $danhMucHinh = Session::get('gal_del');
        // var_dump($danhMucHinh[0]);

        // $test = DB::table('danhmuchinh')->where('maHinhSanPham', $danhMucHinh[0])->get();

        // var_dump($test);

        // Session::forget('gal_del');
        // }

        
        $data = array();
        $dataDanhMucHinh = array();

        // $data3 = session()->all();
        //  var_dump($data3); exit;

        // Lấy hình ảnh của sản phẩm cần cập nhật trong db //
        $hinhAnh = DB::table('dbsanpham')->where('maSanPham', $pro_id)->get();

        // Gán $data['hinhAnh'] mặc định = hình ảnh của sản phẩm cần cập nhật trong db
        foreach($hinhAnh as $key => $pro){
            $data['hinhAnh'] = $pro->hinhAnh;
        }
        
        // Lấy các trường value sản phẩm //
        $data['tenSanPham'] = $request->tenSanPham;
        $data['slug'] = $request->slug_sanpham;
        $data['giaSanPham'] = $request->giaSanPham;
        $data['moTaSanPham'] = $request->moTaSanPham;
        $data['maDanhMuc'] = $request->danhMucSanPham;
        $data['maThuongHieu'] = $request->thuongHieu;
        $data['trangThai'] = $request->trangThai;
        $dataDanhMucHinh['maSanPham'] = $pro_id;

        $get_image = $request->file('hinhAnh');

        // Danh mục hình
        $gallery_image = $request->file('file');


        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/products', $get_name_image);
            unlink('public/upload/products/'.$data['hinhAnh']);
            $data['hinhAnh'] = $get_name_image;

            // var_dump($data); exit;
            // DB::table('dbsanpham')->where('maSanPham', $pro_id)->update($data);
            // Session::put('message', 'Cập nhật thành công');
            // return Redirect::to('/liet-ke-san-pham.html')->with('error_code', 5);
        }
        // Duyệt từng hình ảnh trong danh mục hình //
        if($gallery_image){
            foreach($gallery_image as $image){
                $get_name_image = $image->getClientOriginalName(); // Lấy tên file
                $image->move('public/upload/gallery', $get_name_image); // Di chuyển vào public //
                $dataDanhMucHinh['hinh'] = $get_name_image; // Gán tên hình vào mảng dataDanhMucHinh

                DB::table('danhmuchinh')->insert($dataDanhMucHinh); // insert hình vào db //
                //Session::put('message', 'Thêm thành công');
                
                //return Redirect::to('/liet-ke-user.html')
            }
        }
        
        // update sản phẩm trong db //
        $n = DB::table('dbsanpham')->where('maSanPham', $pro_id)->update($data);
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
        $hinhAnh = DB::table('dbsanpham')->where('maSanPham', $pro_id)->get();
        foreach($hinhAnh as $key => $pro){
            $data['hinhAnh'] = $pro->hinhAnh;
        }
        // Xóa hình ảnh trong thư mục public //
        unlink('public/upload/products/'.$data['hinhAnh']);
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
        // Sidebar //
        $all_brands = Brand::leftJoin("dbsanpham", function($join){
            $join->on("thuonghieu.mathuonghieu", "=", "dbsanpham.mathuonghieu");
        })
        ->select("thuonghieu.*", DB::raw('count(dbsanpham.masanpham) as sl'))
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();
        $all_category_products = CategoryProduct::orderby('maDanhMuc')->get();
        $count_danhMucCon = CategoryProduct::select( "danhmucsanpham.maDanhMuc as maDanhMucCha","danhmucsanpham.tenDanhMuc","danhmucsanpham.slug",DB::raw('(select count(*) from danhmucsanpham where danhmucsanpham.danhMucCha = maDanhMucCha) as SL'))
        ->where('danhmucsanpham.danhMucCha', 0)
        ->get();
        // End sidebar //

        // Header //
        $cate_of_Apple = CategoryProduct::whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = CategoryProduct::select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();

        // end header


        // Lấy keyword qua biên get //
        $kw = $_GET['kw'];

        // $count_search = Product::join("danhmucsanpham", function($join){
        //     $join->on("dbsanpham.maDanhMuc", "=", "danhmucsanpham.maDanhMuc");
        // })
        // ->join("thuonghieu", function($join){
        //     $join->on("dbsanpham.maThuongHieu", "thuonghieu.maThuongHieu", "=");
        // })
        // ->select("dbsanpham.*", "danhmucsanpham.tendanhmuc", "thuonghieu.tenthuonghieu")
        // ->where("thuonghieu.tenThuongHieu", "like", "%".$kw."%")
        // ->orwhere("danhmucsanpham.tenDanhMuc", "like", "%".$kw."%")
        // ->orwhere("dbsanpham.tenSanPham", "like", "%".$kw."%")
        // ->orwhere("dbsanpham.giaSanPham", "like", "%".$kw."%")
        // ->orwhere("dbsanpham.moTaSanPham", "like", "%".$kw."%")
        // ->get();
        

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

        return view('frontend.pages.productsPages.searchPage')->with('all_brands', $all_brands)
        ->with('all_category_products', $all_category_products)
        ->with('count_danhMucCon', $count_danhMucCon)
        ->with('cate_of_Apple', $cate_of_Apple)
        ->with('cate_of_Gear', $cate_of_Gear)
        ->with('result_search', $result_search);
    }
}