<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
use Mail;
use Auth;
use App\User;
use App\Admin;
session_start();

class OrderController extends Controller
{
    // Kiểm tra đã đăng nhập hay chưa //
    public function checkLogin(){
        // Lấy id user từ trong session //
        $isLogin = Auth::guard('admin')->check();
        // Nếu id user = null - chưa đăng nhập, return về trang đăng nhập //
        if(!$isLogin)
            return Redirect::to('/admin-login.html')->send();
    }

    // Hiển thị các đơn hàng //
    public function lietKeDonHang(){
        $this->checkLogin();

        $all_order = DB::table('donhang')->orderby('maDonHang', 'DESC')->get();
        return view('backend.pages.donHang.lietKeDonHang')->with('all_order', $all_order);
    }
    // Hiển thị chi tiết đơn hàng //
    public function chiTietDonHang($order_id){
        $this->checkLogin();
        $order_by_id = DB::table('donhang')->where('maDonHang', $order_id)->first();
        
        // Lấy chi tiết sản phẩm, tên sản phẩm dựa vào mã đơn hàng //
        $order_detail = DB::table("chitietdonhang")
        ->join("dbsanpham", function($join){
            $join->on("chitietdonhang.masanpham", "=", "dbsanpham.masanpham");
        })
        ->select("chitietdonhang.*", "dbsanpham.tensanpham")
        ->where("chitietdonhang.madonhang", "=", $order_id)
        ->get();

        return view('backend.pages.donHang.lietKeChiTietDonHang')->with('order_by_id', $order_by_id)->with('order_detail', $order_detail);
    }
    
    // public function suaKhachHang(){
    //     $this->checkLogin();
    //     return view('backend.pages.donHang.suaKhachHang');
    // }
    // public function suaChiTietDonHang(){
    //     $this->checkLogin();
    //     return view('backend.pages.donHang.suaChiTietDonHang');
    // }
    // public function themDonHang(){
    //     return view('backend.pages.donHang.themDonHang');
    // }
    // public function update_qty(Request $request){
	// 	$data = $request->all();
    //     $order_detail = DB::table("chitietdonhang")->where('maDonHang', $data['order_id'])->where('maSanPham', $data['order_product_id'])->get();

    //     DB::table('chitietdonhang')->where('maDonHang', $data['order_id'])->where('maSanPham', $data['order_product_id'])->update(['soLuong' => $data['order_qty']]);
        
    //     $sum = 0;
    //     $order_total = DB::table("chitietdonhang")->where('maDonHang', $data['order_id'])->get();
    //     //var_dump($order_total); exit;
    //     foreach($order_total as $key => $order){
    //         $sum += $order->giaSanPham * $order->soLuong;
    //     }
    //     DB::table('donhang')->where('maDonHang', $data['order_id'])->update(['tongTien' => $sum]);

	// }

    // Cập nhật trạng thái đơn hàng //
    public function update_status_order(Request $request){
        $this->checkLogin();
        // Lấy value trạng thái đơn hàng //
        $choosen = $request->state_order;
        $id_order = $request->id_order;
        // update trạng thái đơn hàng trong db // 
        DB::table('donhang')->where('maDonHang', $id_order)->update(['trangThaiDonHang' => $choosen]);
        Alert::success('Cập nhật thành công');

        return Redirect::back();
    }
}
