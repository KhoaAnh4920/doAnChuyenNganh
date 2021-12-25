<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
session_start();

class OrderController extends Controller
{
    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }

    public function lietKeDonHang(){
        $this->checkLogin();

        $all_order = DB::table('donhang')->orderby('maDonHang', 'DESC')->get();
        return view('backend.pages.donHang.lietKeDonHang')->with('all_order', $all_order);
    }
    public function chiTietDonHang($order_id){
        $this->checkLogin();
        $order_by_id = DB::table('donhang')->where('maDonHang', $order_id)->first();
        //var_dump($order_by_id); exit;
        $order_detail = DB::table("chitietdonhang")
        ->join("dbsanpham", function($join){
            $join->on("chitietdonhang.masanpham", "=", "dbsanpham.masanpham");
        })
        ->select("chitietdonhang.*", "dbsanpham.tensanpham")
        ->where("chitietdonhang.madonhang", "=", $order_id)
        ->get();


        
        return view('backend.pages.donHang.lietKeChiTietDonHang')->with('order_by_id', $order_by_id)->with('order_detail', $order_detail);
    }
    public function suaKhachHang(){
        $this->checkLogin();
        return view('backend.pages.donHang.suaKhachHang');
    }
    public function suaChiTietDonHang(){
        $this->checkLogin();
        return view('backend.pages.donHang.suaChiTietDonHang');
    }
    public function themDonHang(){
        return view('backend.pages.donHang.themDonHang');
    }
    public function update_qty(Request $request){
		$data = $request->all();
        $order_detail = DB::table("chitietdonhang")->where('maDonHang', $data['order_id'])->where('maSanPham', $data['order_product_id'])->get();

        DB::table('chitietdonhang')->where('maDonHang', $data['order_id'])->where('maSanPham', $data['order_product_id'])->update(['soLuong' => $data['order_qty']]);
        
        $sum = 0;
        $order_total = DB::table("chitietdonhang")->where('maDonHang', $data['order_id'])->get();
        //var_dump($order_total); exit;
        foreach($order_total as $key => $order){
            $sum += $order->giaSanPham * $order->soLuong;
        }
        DB::table('donhang')->where('maDonHang', $data['order_id'])->update(['tongTien' => $sum]);


		// $order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		// $order_details->product_sales_quantity = $data['order_qty'];
		// $order_details->save();
	}
    public function update_status_order(Request $request){
        $this->checkLogin();
        $choosen = $request->state_order;
        $id_order = $request->id_order;
        DB::table('donhang')->where('maDonHang', $id_order)->update(['trangThaiDonHang' => $choosen]);
        Alert::success('Cập nhật thành công');

        return Redirect::back();
    }
}
