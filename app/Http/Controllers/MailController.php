<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
use View;
use App\CateNews;
use App\News;
use Mail;
use Carbon\Carbon;
session_start();

class MailController extends Controller
{
    // Gửi mail đặt lại mật khẩu //
    public function recover_pass(Request $request){
    	$data = $request->all();
        $data2 = array();
		$dt= Carbon::now('Asia/Ho_Chi_Minh');
        $now = $dt->toDateTimeString();
		$title_mail = "Reset password ";
		$customer = DB::table('users')->where('users_email','=',$data['users_email'])->get();
		// foreach($customer as $key => $value){
		// 	$customer_id = $value->users_id;
		// }
		
        // Kiểm tra user có tồn tại trong hệ thống //
		if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                Alert::error('Email chưa được đăng ký');
                return redirect()->back();
            }else{
               	$token_random = Str::random();
                $data2['email'] = $data['users_email'];
                $data2['token'] = $token_random;
                $data2['created_at']=$now;
                DB::table('password_reset')->insert($data2); // insert vào bảng password_reset //

                // $customer = DB::table('users')->where('users_id',$customer_id)->first();

                // $customer->customer_token = $token_random;
                // $customer->save();
                //send mail
              
                $to_email = $data['users_email'];//send to this email
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
             
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['users_email']); //body of mail.blade.php
                
                Mail::send('frontend.pages.loginUserPages.notify_recoverPass', ['data'=>$data] , function($message) use ($title_mail,$data){
		            $message->to($data['email'])->subject($title_mail);//send this mail with subject
		            $message->from($data['email'],$title_mail);//send from this mail
	    		});
                //--send mail
                Alert::success('Gửi mail thành công. Vui lòng kiểm tra email để tiến hành đặt lại mật khẩu');
                return redirect()->back();
            }
        }
    }
    // Trang cho người dùng cập nhật lại mật khẩu mới //
    public function updateNewPass(){
        // Lấy email và token qua biến get //
        $email = $_GET['email'];
        $token = $_GET['token'];

        // Lấy ngày hiện tại của hệ thống //
        $dt= Carbon::now('Asia/Ho_Chi_Minh');
        $now = $dt->toDateTimeString();
        // Lấy thông tin user dựa vào email và token trong bảng password_reset //
        $customer = DB::table('password_reset')->where('email','=',$email)->where('token','=', $token)->get();
        // Kiểm tra user có tồn tại hay không //
        if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                Alert::error('Email hoặc token không hợp lệ');
                return Redirect::to('/login.html')->send();
            }else{
                foreach($customer as $key => $cus){ // Lấy thời gian đã lưu trong bảng password_reset //
                    $created_at = $cus->created_at;
                }
                if($dt->diffInDays($created_at) > 1){ // So sánh thời gian của hiện tại so với thời gian đã lưu trong bảng password_reset
                    Alert::error('Link quá hạn');
                    return Redirect::to('/login.html')->send();
                }else{
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
                    return view('frontend.pages.loginUserPages.newPassword')->with('email', $email)->with('token', $token);
                }
            }
        }
    }
    // Xử lý cập nhật mật khẩu mới //
    public function handleUpdatePass(Request $request){
        $data = $request->all();
        // Kiểm tra nhập lại mật khẩu có trùng với mật khẩu trước đó không //
        if($data['users_password'] == $data['users_RePassword']){
            // update lại mật khẩu trong db //
            $n = DB::table('users')->where('users_email', $data['email'])->update(['users_password' => md5($data['users_password'])]);
            if($n){
                // Nếu đã update thành công thì xóa user trong bảng password_reset //
                DB::table('password_reset')->where('email', $data['email'])->delete();
                Alert::success('Đổi mật khẩu thành công');
                return Redirect::to('/login.html')->send();
            }else{
                Alert::error('Cập nhật thất bại');
                return redirect()->back();
            }
        }else{
            Alert::error('Mật khẩu không trùng khớp');
            return redirect()->back();
        }
        
    }
    // Gửi mail yêu cầu kích hoạt tài khoản //
    public function guiMailActive($user_email, $users_id, $token){
        $title_mail = "Kích hoạt tài khoản ";
        $to_email = $user_email;//send to this email
        $link_reset_pass = url('/actice-account?id='.$users_id.'&token='.$token);
             
        $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$to_email); //body of mail.blade.php
                
        Mail::send('frontend.pages.loginUserPages.notify_activeAccount', ['data'=>$data] , function($message) use ($title_mail,$data){
		    $message->to($data['email'])->subject($title_mail);//send this mail with subject
		    $message->from($data['email'],$title_mail);//send from this mail
	    });
        //--send mail
        return true;
    }
    
    // Đăng ký user - frontend //
    public function signInUser(Request $request){
        $data = array();
        // Lấy value tên người dùng //
        $data['users_name'] = $request->users_name;
        // Lấy email người dùng //
        $data['users_email'] = $request->users_email;

        $all_users = DB::table('users')->orderBy('users_id', 'DESC')->get();
        // Kiểm tra email vừa nhập đã tồn tại trong hệ thống chưa //
        foreach($all_users as $key => $u){
            if($u->users_email == $data['users_email']){
                Alert::error('Email đã tồn tại');
                return redirect()->back();
            }
        }

        // Lấy mật khẩu, mã hóa bằng md5 //
        $data['users_password'] = md5($request->users_password);
        // Lấy địa chỉ người dùng //
        $data['users_address'] = $request->users_address;
        // Lấy sđt người dùng //
        $data['users_phone'] = $request->users_phone;
        // Lấy role của người dùng //
        $data['users_role'] = $request->role;
        // Trường active mặc định = 0 //
        $data['active'] = 0;
        // Tạo chuỗi ngẫu nhiên // 
        $data['token'] = Str::random();
        // Lấy hình ảnh //
        $get_image = $request->file('user_avatar');

        //Kiểm tra nếu người dùng có chọn ảnh //
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/avatar', $get_name_image); // Di chuyển hình ảnh vào thư mục public //
            $data['users_avatar'] = $get_name_image;

            // Insert data vào db //
            $n = DB::table('users')->insert($data);
            if($n > 0){
                // Lấy id user vừa mới thêm vào db //
                $users = DB::table('users')->orderBy('users_id', 'DESC')->first();
                $id = $users->users_id;
                // Gửi mail yêu cầu kích hoạt tài khoản //
                if($this->guiMailActive($data['users_email'], $id, $data['token'])){
                    Alert::success('Gửi mail thành công. Vui lòng kiểm tra email để tiến hành kích hoạt tài khoản');
                    return redirect()->back();    
                }
            }else
                Alert::error('Đăng ký thất bại thất bại');
            return redirect()->back();
        }
        // Nếu người dùng không chọn ảnh, gán mặc định bằng unknown.png //
        $data['users_avatar'] = "unknown.png";
    
        // Insert data vào db //
        $n = DB::table('users')->insert($data);
        if($n > 0){
            // Lấy id user vừa mới thêm vào db //
            $users = DB::table('users')->orderBy('users_id', 'DESC')->first();
            $id = $users->users_id;
            // Gửi mail yêu cầu kích hoạt tài khoản //
            if($this->guiMailActive($data['users_email'],$id, $data['token'])){
                Alert::success('Gửi mail thành công. Vui lòng kiểm tra email để tiến hành kích hoạt tài khoản');
                return redirect()->back();  
            }
                 
        }
        else
            Alert::error('Đăng ký thất bại');
        return redirect()->back();
    }
    // Xử lý kích hoạt tài khoản //
    public function activeAccount(){
        // Lấy id và token qua biến Get //
        $id = $_GET['id'];
        $token = $_GET['token'];
        // Lấy thông tin user dựa vào id và token //
        $users = DB::table('users')->where('users_id', $id)->where('token', $token);
        // Kiểm tra user có tồn tại hay không //
        if($users){
            $count_user = $users->count();
            // Nếu user không tồn tại => id hoặc token sai //
            if($count_user == 0){
                Alert::error('Dữ liệu không hợp lệ');
                return Redirect::to('/login.html')->send();
            }else{ // Nếu có tồn tại user, update trường active = 1 //
                $n = DB::table('users')->where('users_id', $id)->update(['active' => 1]);
                if($n){
                    Alert::success("Kích hoạt tài khoản thành công");
                    return Redirect::to('/login.html')->send();
                }else{
                    Alert::error('Lỗi kích hoạt tài khoản');
                    return Redirect::to('/login.html')->send();
                }
            }
        }
    }

    // Gửi mail liên hệ //
    public function guiMailLienHe($user_email, $message, $subject, $name){
        $title_mail = $subject;
        $to_email = 'khoadido@gmail.com';//send to this email
        //$link_reset_pass = url('/actice-account?id='.$users_id.'&token='.$token);
             
        $data = array("name"=>$title_mail,'email'=>$user_email, 'message' =>$message, 'name', $name); //body of mail.blade.php
                
        Mail::send('frontend.pages.contactPages.notify_contact', ['data'=>$data] , function($message) use ($title_mail,$data, $to_email){
		    $message->to($to_email)->subject($title_mail);//send this mail with subject
		    $message->from($to_email,$title_mail);//send from this mail
	    });
        //--send mail
        return true;
    }
    // Xử lý liên hệ //
    public function handleContact(Request $request){
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        $result = $this->guiMailLienHe($email, $message, $subject, $name);
        if($result){
            Alert::success("Cám ơn bạn đã để lại lời nhắn. Chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất");
            return Redirect::to('/trang-chu.html');
        }else{
            Alert::error('Đã có lỗi xảy ra');
            return redirect()->back(); 
        }
    }
}
