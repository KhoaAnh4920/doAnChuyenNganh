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

    public function checkLogin(){
        $user_id = Session::get('user_id');
        if($user_id == null)
            return redirect()->back();
    }
    
    // Trang xem đơn hàng trên frontend của người dùng // 
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

        // Lấy id người dùng từ session //
        $users_id = Session::get('user_id');
        // Lấy thông tin đơn hàng của người dùng //
        $info_order = DB::table('donhang')->where('users_id', $users_id)->get();

        $cart_content = Cart::content();

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);

        return view('frontend.pages.orderPages.checkout')
        ->with('cart_content',$cart_content)
        ->with('info_order', $info_order);
    }
    // Trang xem những sản phẩm đã đặt trên trang frontend //
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
        
        // Lấy dữ liệu chi tiết đơn hàng //
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
    
    
    // Trang đăng nhập user //
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
    // Trang liên hệ //
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
    // Liệt kê các hình slider //
    public function lietKeSlider(){
        $this->checkLogin();
        $all_slider = Slider::orderBy('maSlider', 'DESC')->get();

        return view('backend.pages.slider.lietKeSlider')->with('all_slider', $all_slider);
    }

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
    // Trang thêm slider của admin //
    public function themSlider(){
        return view('backend.pages.slider.themSlider');
    }
    // Thêm hình ảnh slider vào db // 
    public function createSlider(Request $request){

        $this->checkLogin();
        // Tạo đối tượng slider từ model //
        $slider = new Slider();
        $slider->tenSlider = $request->slider_name;
        $slider->moTa = $request->slider_desc;
        $slider->trangThai = $request->slider_status;

        // Lấy hình ảnh người dùng chọn //
        $get_image = $request->file('slider_img');
        // Nếu người dùng có chọn hình và hình ảnh hợp lệ //
        if($get_image && $this->checkimg($get_image)){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/slider', $get_name_image); // Di chuyển hình vào public 
            $slider->hinhAnh = $get_name_image;

            // Lưu hình ảnh vào db //
            $slider->save();
            Alert::success('Thêm thành công');
            return Redirect::to('/liet-ke-slider.html');
        }else
            Alert::error('Ảnh không hợp lệ');
        return Redirect::to('/liet-ke-slider.html');

    }
    // Xóa slider trong db //
    public function deleteSlider($slide_id){
        // Lấy hình ảnh trong db cần xóa, dựa vào mã //
        $slide = Slider::find($slide_id); 
        // Xóa hình ảnh trong public //
        unlink('public/upload/slider/'.$slide->hinhAnh);
        // Xóa hình ảnh trong db //
        Slider::where('maSlider', $slide_id)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }
    // Trang quên mật khẩu
    public function forgotPass(){
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
        return view('frontend.pages.loginUserPages.forgotPass');
    }
}