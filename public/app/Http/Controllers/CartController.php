<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
session_start();
use Cart;
use View;
use Alert;
use Mail;
use Carbon\Carbon;
use Auth;
use App\User;

class CartController extends Controller
{
    // Trang hiển thị giỏ hàng //
    public function cart(){
        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();

        // Lấy sản phẩm trong giỏ hàng //
        $contentCart = Cart::content();
      
        //Cart::destroy();

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);
        
        return view('frontend.pages.orderPages.cart')
        ->with('contentCart', $contentCart);
    }

    // Thêm sản phẩm trong giỏ hàng
    public function addCart(Request $request){
        $data = array();
        $pro_id = $request->product_id; // Lấy mã sản phẩm //
        $qty_pro = $request->qty_pro; // Lấy số lượng của sản phẩm //

        // Kiểm tra số lượng sản phẩm có hợp lệ //
        if($qty_pro < 1){
            Alert::error('Số lượng sản phẩm không hợp lệ');
            return redirect()->back();
        }
        
        // Lấy thông tin của sản phẩm, slug của danh mục sp, slug của thương hiệu, tên danh mục, tên thương hiệu //
        $product = DB::table("dbsanpham")
        ->join("danhmucsanpham", function($join){
            $join->on("dbsanpham.maDanhMuc", "=", "danhmucsanpham.maDanhMuc");
        })
        ->join("thuonghieu", function($join){
            $join->on("thuonghieu.maThuongHieu", "dbsanpham.maThuongHieu", "=");
        })
        ->select("dbsanpham.*", "danhmucsanpham.tenDanhMuc", "danhmucsanpham.slug as slug_Cate","thuonghieu.tenThuongHieu", "thuonghieu.slug as slug_Brand")
        ->where("dbsanpham.masanpham", "=", $pro_id)
        ->first();
        
        // Gán các thông tin của sản phẩm vào mảng data;
        $data['id']= $product->maSanPham;
        $data['qty']= $qty_pro;
        $data['price']= $product->giaSanPham;
        $data['name']= $product->tenSanPham;
        $data['options']['image']= $product->hinhAnh;
        $data['options']['category']= $product->tenDanhMuc;
        $data['options']['brand']= $product->tenThuongHieu;
        $data['options']['slug_Pro']= $product->slug;
        $data['options']['slug_Cate']= $product->slug_Cate;
        $data['options']['slug_Brand']= $product->slug_Brand;

        // add data vào đối tượng cart //
        Cart::add($data);
        Alert::success('Thêm giỏ hàng thành công');

        return redirect()->back();
    }
    // Xóa sản phẩm trong giỏ hàng //
    public function DeleteItemCart($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }
    // Cập nhật số lượng sản phẩm trong giỏ hàng //
    public function updateCart(Request $request){
        $data = array();
        $data = $request->quanlity; // Mảng số lượng 
        $i = 0; // Biến đếm bao nhiêu sản phẩm đc cập nhật thành công //
    
        // Duyệt từng số lượng sản phẩm trong mảng //
       foreach($data as $key => $qty_pro){
           $rowId = $key;
           $qty = $qty_pro;
            // Nếu số lượng sản phẩm > 0 thì mới cập nhật //
           if($qty > 0){
                $i++;
                Cart::update($rowId, $qty);
           }    
       }
        if($i > 0)
            Alert::success('Cập nhật thành công '.$i.' sản phẩm');
        else
            Alert::error('Cập nhật thất bại');
        return redirect()->back();
    }
    // Xóa tất cả sản phẩm trong giỏ hàng //
    public function DeleteAllCart(){
        if(Cart::count() != 0){
            Cart::destroy();
        }
        return redirect()->back();
    }
    // Kiểm tra đã đăng nhập hay chưa //
    public function checkLogin(){
        // Lấy id user từ trong session //
        $isLogin = Auth::guard('user')->check(); 
        // Nếu id user = null - chưa đăng nhập, return -1 //
        if($isLogin == null){
            return -1;
        }
        // Lấy thông tin user đã được active hay chưa //
        $user_id = Auth::guard('user')->user()->users_id;
        $userActive = DB::table('users')->where('users_id', $user_id)->first();
        // Nếu chưa active, return về 0 //
        if($userActive->active != 1){
            return 0;
        }
        // Nếu đã active return về 1 //
        return 1;
    }
    // Trang đặt hàng của frontend //
    public function order(){
        // Check login //
        $n = $this->checkLogin();
        // Người dùng chưa đăng nhập // 
        if($n == -1){
            Alert::error('Vui lòng đăng nhập tài khoản để đặt hàng');
            return Redirect::to('/login.html');
        }else if($n == 0){ // Tài khoản người dùng chưa active //
            Alert::error('Vui lòng kích hoạt tài khoản để đặt hàng');
            return Redirect::to('/trang-chu.html');
        }

        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();
        //var_dump($cate_of_Gear); exit;

        // end header

        // Lấy id user //
        $users_id = Auth::guard('user')->user()->users_id;
        // Lấy thông tin user dựa vào id //
        $info_user = DB::table('users')->where('users_id', $users_id)->get();
        
        $cart_content = Cart::content();

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);

        return view('frontend.pages.orderPages.order')->with('cart_content',$cart_content)->with('info_user', $info_user);
    }
    // Gửi mail xác nhận đặt hàng //
    public function sendMailOrder($data, $cart_content, $email){
        $title_mail = "Xác nhận đặt hàng ";
        //$to_email = $email;
        $data['email'] = $email; //send to this email
       // $link_reset_pass = url('/actice-account?id='.$users_id.'&token='.$token);
             
       // $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$to_email); //body of mail.blade.php
                
        Mail::send('frontend.pages.orderPages.notify_orderMail', ['data'=>$data, 'oderDetail' =>$cart_content] , function($message) use ($title_mail,$data){
		    $message->to($data['email'])->subject($title_mail);//send this mail with subject
		    $message->from($data['email'],$title_mail);//send from this mail
	    });
        //--send mail
        return true;
    }
    // Xử lý đặt hàng //
    public function handleOrder(Request $request){
        $data = array();

        // Thêm vào data đơn hàng //
        $email = $request->order_cusEmail;
        $data['tenNguoiNhanHang'] = $request->order_cusName;
        $data['soDienThoai'] = $request->order_cusPhone;
        //$data['ngayDatHang'] = $request->order_cusPhone;
        $data['diaChiGiaoHang'] = $request->order_cusAddress;
        $data['tongTien'] = $request->total_price;
        $data['trangThaiDonHang'] = 0;
        $data['users_id'] = $request->users_id;
        $data['ngayDatHang'] = Carbon::now('Asia/Ho_Chi_Minh');

        DB::table('donhang')->insert($data);

        // Thêm vào data chi tiết đơn hàng //

        // Lấy id đơn hàng vừa thêm //
        $get_id_order = DB::table('donhang')->select('maDonHang')->orderBy('maDonHang', 'DESC')->first();

        $id_order = $get_id_order->maDonHang;
   

        $cart_content = Cart::content();
        $dataChiTiet = array();
        $dataChiTiet['maDonHang'] = $id_order;
        // Lấy tất cả sản phẩm trong giỏ hàng thêm vào chi tiết đơn hàng //
        foreach($cart_content as $key =>$cart_pro){
            $dataChiTiet['maSanPham'] = $cart_pro->id;
            $dataChiTiet['giaSanPham'] = $cart_pro->price;
            $dataChiTiet['soLuong'] = $cart_pro->qty;
            //var_dump($dataChiTiet); exit;
            DB::table('chitietdonhang')->insert($dataChiTiet);
        }
        // Gửi mail xác nhận đặt hàng - Tham số truyền vào: $data: đơn hàng, $cart_content: giỏ hàng, $email: email của khách hàng //
        $this->sendMailOrder($data, $cart_content, $email);
        Cart::destroy();
        Alert::success('Đặt hàng thành công');
        return Redirect::to('/trang-chu.html');
    }
}