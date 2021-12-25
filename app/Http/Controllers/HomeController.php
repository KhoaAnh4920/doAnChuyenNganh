<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Cart;
use View;
use App\Slider;
use Alert;
session_start();

class HomeController extends Controller
{
    // front end // 
    public function index(){
        // Sidebar //
        $all_brands = DB::table("thuonghieu")
        ->leftJoin("dbsanpham", function($join){
            $join->on("thuonghieu.mathuonghieu", "=", "dbsanpham.mathuonghieu");
        })
        ->select("thuonghieu.*", DB::raw('count(dbsanpham.masanpham) as sl'))
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();

        $all_category_products = DB::table('danhmucsanpham')->orderby('maDanhMuc')->get();
        // end sidebar//

        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();
        // end header

        // Đếm số lượng danh mục con của từng danh mục cha //
        $count_danhMucCon = DB::table('danhmucsanpham')
        ->select( "danhmucsanpham.maDanhMuc as maDanhMucCha","danhmucsanpham.tenDanhMuc","danhmucsanpham.slug",DB::raw('(select count(*) from danhmucsanpham where danhmucsanpham.danhMucCha = maDanhMucCha) as SL'))
        ->where('danhmucsanpham.danhMucCha', 0)
        ->get();
        
        // Danh sách điện thoại nổi bật // 
        $danhSachDienThoai = DB::table("dbsanpham")
        ->whereIn("dbsanpham.madanhmuc", function($query){
            $query->from("danhmucsanpham")
            ->select("danhmucsanpham.madanhmuc")
            ->where("danhmucsanpham.danhmuccha", "=", 8);
        })
        ->get();
        

        // Đếm số lượng sản phẩm thuộc danh mục điện thoại // 
        $countdanhSachDienThoai = DB::table("dbsanpham")
        ->select(DB::raw('count(dbsanpham.masanpham) as sl'))
        ->whereIn("dbsanpham.madanhmuc", function($query){
            $query->from("danhmucsanpham")
            ->select("danhmucsanpham.madanhmuc")
            ->where("danhmucsanpham.danhmuccha", "=", 8);
        })
        ->first();

        // Danh mục con của điện thoại // 
        $danhMucConDienThoai = DB::table("danhmucsanpham")
        ->select("danhmucsanpham.tenDanhMuc", "danhmucsanpham.slug")
        ->where("danhmucsanpham.danhmuccha", "=", 8)
        ->get();
        

        // Danh sách Laptop nổi bật // 
        $danhSachLaptop = DB::table("dbsanpham")
        ->whereIn("dbsanpham.madanhmuc", function($query){
            $query->from("danhmucsanpham")
            ->select("danhmucsanpham.madanhmuc")
            ->where("danhmucsanpham.danhmuccha", "=", 7);
        })
        ->limit(6)->get();


        // Đếm số lượng sản phẩm thuộc danh mục Laptop // 
        $countdanhSachLaptop = DB::table("dbsanpham")
        ->select(DB::raw('count(dbsanpham.masanpham) as sl'))
        ->whereIn("dbsanpham.madanhmuc", function($query){
            $query->from("danhmucsanpham")
            ->select("danhmucsanpham.madanhmuc")
            ->where("danhmucsanpham.danhmuccha", "=", 7);
        })
        ->first();

        // Danh mục con của laptop // 
        $danhMucConLaptop = DB::table("danhmucsanpham")
        ->select("danhmucsanpham.tenDanhMuc", "danhmucsanpham.slug")
        ->where("danhmucsanpham.danhmuccha", "=", 7)
        ->get();
        

        // Sản phẩm bán chạy // 
        $recommmendedProducts = DB::table("dbsanpham")
        ->limit(6)
        ->get();

        // Lấy slider //
        $all_slider = Slider::where('trangThai', 1)->orderBy('maSlider', 'ASC')->get();

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);

        return view('frontend.pages.topPages.index')->with('all_brands', $all_brands)
        ->with('all_category_products', $all_category_products)
        ->with('recommmendedProducts', $recommmendedProducts)
        ->with('count_danhMucCon', $count_danhMucCon)
        ->with('danhSachDienThoai', $danhSachDienThoai)
        ->with('danhMucConDienThoai', $danhMucConDienThoai)
        ->with('countdanhSachDienThoai', $countdanhSachDienThoai)
        ->with('danhSachLaptop', $danhSachLaptop)
        ->with('countdanhSachLaptop', $countdanhSachLaptop)
        ->with('danhMucConLaptop', $danhMucConLaptop)
        ->with('all_slider', $all_slider);
        // ->with('cate_of_Apple', $cate_of_Apple)
        // ->with('cate_of_Gear', $cate_of_Gear);
    }

    // public function load_more_product(Request $request){

    //     $data = $request->all();

    //     // Click vào load more //
    //     if($data['id'] > 0){
    //         $newProducts = DB::table("dbsanpham")->where('trangThai', '1')->where('maSanPham', '<', $data['id'])->orderby('maSanPham', 'DESC')->take(6)->get();
    //     }else{ // Mặc định mới vào trang // 
    //         $newProducts = DB::table("dbsanpham")->orderby('maSanPham', 'DESC')->take(6)->get();
    //     }

        
    //     $output = '';
    //     if(!$newProducts->isEmpty()){
    //         foreach($newProducts as $key => $pro_new){
    //             $last_id = $pro_new->maSanPham;
    //             $output.="
                
    //             <div class='col-sm-4'>
    //                 <div class='product-image-wrapper'>
    //                     <div class='single-products'>
    //                         <div class='productinfo text-center'>
    //                             <a href='".url('/product-details.html/'.$pro_new->slug)."'><img
    //                                     style='width:200px' src='public/upload/products/$pro_new->hinhAnh' alt='$pro_new->tenSanPham' /></a>
    //                             <h2>".number_format($pro_new->giaSanPham)." VNĐ</h2>
    //                             <a href='".url('/product-details.html/'.$pro_new->slug)."'>
    //                                 <p>$pro_new->tenSanPham</p>
    //                             </a>
    //                             <a href='".url('/product-details.html/'.$pro_new->slug)."' class='btn btn-default add-to-cart'>Chi tiết <i class='fa fa-arrow-right'></i></a>
    //                         </div>
    
    //                     </div>
    //                 </div>
    //             </div>";
    //         }
    //         $output .="
    //                 <div id='load_more'>
    //                     <button name='load_more_button' class='btn btn-primary form-control' data-id='".$last_id."'
    //                     id ='load_more_button'>Xem thêm <i class='fa fa-angle-double-down' aria-hidden='true'></i></button>
    //                 </div>
                
    //             ";
    //     }else{
    //         $output .="
    //                 <div id='load_more'>
    //                     <button type='button' name='load_more_button' class='btn btn-default form-control'
    //                     id ='load_more_button'>Đang cập nhật...</button>
    //                 </div>
                
    //             ";
    //     }
        
        
    //     echo $output;
        
    // }
    public function checkLogin(){
        $user_id = Session::get('user_id');
        if($user_id == null)
            return redirect()->back()->with('error_code', 5);
    }
    
    public function checkout(){
        // Check login //
        $this->checkLogin();
        if(!empty(Session::get('error_code')))
            Session::forget('error_code'); 
        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();
        // end header

        $users_id = Session::get('user_id');
        
        $info_order = DB::table('donhang')->where('users_id', $users_id)->get();

        $cart_content = Cart::content();

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);

        return view('frontend.pages.orderPages.checkout')
        ->with('cart_content',$cart_content)
        ->with('info_order', $info_order);
    }
    public function checkoutDetail($order_id){
        // Check login //
        $this->checkLogin();
        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();
        // end header
        
        $detail_order = DB::table("chitietdonhang")
        ->join("dbsanpham", function($join){
            $join->on("chitietdonhang.masanpham", "=", "dbsanpham.masanpham");
        })
        ->select("chitietdonhang.*", "dbsanpham.tenSanPham", "dbsanpham.hinhAnh")
        ->where("chitietdonhang.madonhang", $order_id)
        ->get();

        //Lấy tổng tiền của đơn hàng //
        $tongTien = DB::table("chitietdonhang")
        ->join("donhang", function($join){
            $join->on("donhang.maDonHang", "=", "chitietdonhang.maDonHang");
        })
        ->select("donhang.tongTien")
        ->where("chitietdonhang.madonhang", $order_id)
        ->first();

        $cart_content = Cart::content();

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);
        
        return view('frontend.pages.orderPages.checkout-detail')
        ->with('cart_content',$cart_content)
        ->with('detail_order', $detail_order)
        ->with('tongTien', $tongTien);
    }
    
    
    
    public function login(){
        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();
        // end header

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);

        return view('frontend.pages.loginUserPages.login');
    }
    public function contact(){
        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();
        // end header

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);

        return view('frontend.pages.contactPages.contact');
    }

    public function lietKeSlider(){
        $this->checkLogin();
        $all_slider = Slider::orderBy('maSlider', 'DESC')->get();

        return view('backend.pages.slider.lietKeSlider')->with('all_slider', $all_slider);
    }

    public function checkimg($h){
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
        // Define maxsize for files i.e 2MB
        $maxsize = 2 * 1024 * 1024;
        $file_name = $h->getClientOriginalName();
        $file_size = $h->getSize();
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // Check file type is allowed or not
        if(in_array(strtolower($file_ext), $allowed_types)) {
            // Verify file size - 2MB max
            if ($file_size > $maxsize) {
                Alert::error('Dung lượng ảnh quá lớn');
                return false;
            }
        }
        else{
            Alert::error('Ảnh không hợp lệ');
            return false;
        }
        return true;
    }
    public function themSlider(){
        return view('backend.pages.slider.themSlider');
    }
    public function createSlider(Request $request){

        $this->checkLogin();
        $slider = new Slider();
        $slider->tenSlider = $request->slider_name;
        $slider->moTa = $request->slider_desc;
        $slider->trangThai = $request->slider_status;

        $get_image = $request->file('slider_img');

        if($get_image && $this->checkimg($get_image)){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/slider', $get_name_image);
            $slider->hinhAnh = $get_name_image;

            $slider->save();
            Alert::success('Thêm thành công');
            return Redirect::to('/liet-ke-slider.html');
        }else
            Alert::error('Ảnh không hợp lệ');
        return Redirect::to('/liet-ke-slider.html');

    }
    public function deleteSlider($slide_id){
        $slide = Slider::find($slide_id); 
        unlink('public/upload/slider/'.$slide->hinhAnh);
        Slider::where('maSlider', $slide_id)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }
}