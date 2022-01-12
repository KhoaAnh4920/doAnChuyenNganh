<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Cart;
use View;
use Alert;
use Auth;
use App\User;
use App\Slider;
session_start();

class HomeController extends Controller
{
    // front end // 
    public function index(){
        // Lấy slider trang chủ //
        $all_slider = Slider::where('trangThai', 1)->where('viTri', 0)->orderBy('maSlider', 'DESC')->get();

        // Danh sách điện thoại nổi bật // 
        $danhSachDienThoai = DB::table("dbsanpham")
        ->whereIn("dbsanpham.madanhmuc", function($query){
            $query->from("danhmucsanpham")
            ->select("danhmucsanpham.madanhmuc")
            ->where("danhmucsanpham.danhmuccha", "=", 8);
        })
        ->where("dbsanpham.trangThai", 1)
        ->limit(6)->get();
        

        // Đếm số lượng sản phẩm thuộc danh mục điện thoại // 
        $countdanhSachDienThoai = DB::table("dbsanpham")
        ->select(DB::raw('count(dbsanpham.masanpham) as sl'))
        ->whereIn("dbsanpham.madanhmuc", function($query){
            $query->from("danhmucsanpham")
            ->select("danhmucsanpham.madanhmuc")
            ->where("danhmucsanpham.danhmuccha", 8);
        })
        ->where("dbsanpham.trangThai", 1)
        ->first();

        // Danh mục con của điện thoại // 
        $danhMucConDienThoai = DB::table("danhmucsanpham")
        ->select("danhmucsanpham.tenDanhMuc", "danhmucsanpham.slug")
        ->where("danhmucsanpham.danhmuccha", 8)
        ->where("danhmucsanpham.trangThai", 1)
        ->limit(3)
        ->get();
        

        // Danh sách Laptop nổi bật // 
        $danhSachLaptop = DB::table("dbsanpham")
        ->whereIn("dbsanpham.madanhmuc", function($query){
            $query->from("danhmucsanpham")
            ->select("danhmucsanpham.madanhmuc")
            ->where("danhmucsanpham.danhmuccha", "=", 7);
        })
        ->where("dbsanpham.trangThai", 1)
        ->limit(6)->get();


        // Đếm số lượng sản phẩm thuộc danh mục Laptop // 
        $countdanhSachLaptop = DB::table("dbsanpham")
        ->select(DB::raw('count(dbsanpham.masanpham) as sl'))
        ->whereIn("dbsanpham.madanhmuc", function($query){
            $query->from("danhmucsanpham")
            ->select("danhmucsanpham.madanhmuc")
            ->where("danhmucsanpham.danhmuccha", "=", 7);
        })
        ->where("dbsanpham.trangThai", 1)
        ->first();

        // Danh mục con của laptop // 
        $danhMucConLaptop = DB::table("danhmucsanpham")
        ->select("danhmucsanpham.tenDanhMuc", "danhmucsanpham.slug")
        ->where("danhmucsanpham.danhmuccha", "=", 7)
        ->where("danhmucsanpham.trangThai", 1)
        ->limit(3)
        ->get();
        

        // Sản phẩm bán chạy // 
        $recommmendedProducts = DB::table("dbsanpham")
        ->where("dbsanpham.trangThai", 1)
        ->limit(6)
        ->get();

        return view('frontend.pages.topPages.index')
        ->with('recommmendedProducts', $recommmendedProducts)
        ->with('danhSachDienThoai', $danhSachDienThoai)
        ->with('danhMucConDienThoai', $danhMucConDienThoai)
        ->with('countdanhSachDienThoai', $countdanhSachDienThoai)
        ->with('danhSachLaptop', $danhSachLaptop)
        ->with('countdanhSachLaptop', $countdanhSachLaptop)
        ->with('danhMucConLaptop', $danhMucConLaptop)
        ->with('all_slider', $all_slider);
    }

    public function checkLogin(){
        $isLogin = Auth::guard('user')->check();
        if(!$isLogin){
            Alert::error("Vui lòng đăng nhập để tiếp tục");
            return redirect()->back()->send();
        }
            
    }
    
    // Trang xem đơn hàng trên frontend của người dùng // 
    public function checkout(){
        // Check login //
        $this->checkLogin();

        // Lấy id người dùng từ auth //
        $users_id = Auth::guard('user')->user()->users_id;
        // Lấy thông tin đơn hàng của người dùng //
        $info_order = DB::table('donhang')->where('users_id', $users_id)->get();


        $cart_content = Cart::content();

        return view('frontend.pages.orderPages.checkout')
        ->with('cart_content',$cart_content)
        ->with('info_order', $info_order);
    }
    // Trang xem những sản phẩm đã đặt trên trang frontend //
    public function checkoutDetail($order_id){
        // Check login //
        $this->checkLogin();
        
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
        
        return view('frontend.pages.orderPages.checkout-detail')
        ->with('cart_content',$cart_content)
        ->with('detail_order', $detail_order)
        ->with('tongTien', $tongTien);
    }
    
    
    // Trang đăng nhập user //
    public function login(){
        return view('frontend.pages.loginUserPages.login');
    }

    // Trang liên hệ //
    public function contact(){
        return view('frontend.pages.contactPages.contact');
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
    
    // Trang quên mật khẩu
    public function forgotPass(){
        return view('frontend.pages.loginUserPages.forgotPass');
    }
}