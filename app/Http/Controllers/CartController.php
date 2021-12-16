<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
session_start();
use Cart;

class CartController extends Controller
{
    public function cart(){

        $contentCart = Cart::content();
      
        //Cart::destroy();
        
        return view('frontend.pages.orderPages.cart')->with('contentCart', $contentCart);
    }

    public function addCart(Request $request){
        $data = array();
        $pro_id = $request->product_id;
        $qty_pro = $request->qty_pro;
  
        $product = DB::table("dbsanpham")
        ->join("danhmucsanpham", function($join){
            $join->on("dbsanpham.maDanhMuc", "=", "danhmucsanpham.maDanhMuc");
        })
        ->join("thuonghieu", function($join){
            $join->on("thuonghieu.maThuongHieu", "dbsanpham.maThuongHieu", "=");
        })
        ->select("dbsanpham.*", "danhmucsanpham.tenDanhMuc", "thuonghieu.tenThuongHieu")
        ->where("dbsanpham.masanpham", "=", $pro_id)
        ->first();
        

        $data['id']= $product->maSanPham;
        $data['qty']= $qty_pro;
        $data['price']= $product->giaSanPham;
        $data['name']= $product->tenSanPham;
        $data['options']['image']= $product->hinhAnh;
        $data['options']['category']= $product->tenDanhMuc;
        $data['options']['brand']= $product->tenThuongHieu;


        Cart::add($data);

        return redirect()->back();
    }
    public function DeleteItemCart($rowId){

        Cart::remove($rowId);
        return redirect()->back();
    }
    public function updateCart(Request $request){

        $data = array();
        $data = $request->quanlity;
        //var_dump($data); exit;

       foreach($data as $key => $qty_pro){
           $rowId = $key;
           $qty = $qty_pro;
           Cart::update($rowId, $qty);
       }
        return redirect()->back();
    }
    public function DeleteAllCart(){
        if(Cart::count() != 0){
            Cart::destroy();
        }
        return redirect()->back();
    }
    public function order(){
        // Check login //
        $users_id = Session::get('users_id');
        
        $info_user = DB::table('users')->where('users_id', $users_id)->get();
        

        $cart_content = Cart::content();
        return view('frontend.pages.orderPages.order')->with('cart_content',$cart_content)->with('info_user', $info_user);
    }
    public function handleOrder(Request $request){
        $data = array();

        $data['tenNguoiNhanHang'] = $request->order_cusName;
        $data['soDienThoai'] = $request->order_cusPhone;
        //$data['ngayDatHang'] = $request->order_cusPhone;
        $data['diaChiGiaoHang'] = $request->order_cusAddress;
        $data['tongTien'] = $request->total_price;
        $data['trangThaiDonHang'] = 0;
        $data['users_id'] = $request->users_id;

        var_dump($data); exit;
        
    }
}