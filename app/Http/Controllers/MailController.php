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
                DB::table('password_reset')->insert($data2);

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
    public function updateNewPass(){
        $email = $_GET['email'];
        $token = $_GET['token'];

        $dt= Carbon::now('Asia/Ho_Chi_Minh');
        $now = $dt->toDateTimeString();

        $customer = DB::table('password_reset')->where('email','=',$email)->where('token','=', $token)->get();
        if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                Alert::error('Email hoặc token không hợp lệ');
                return Redirect::to('/login.html')->send();
            }else{
                foreach($customer as $key => $cus){
                    $created_at = $cus->created_at;
                }
                if($dt->diffInDays($created_at) > 1){
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
    public function handleUpdatePass(Request $request){
        $data = $request->all();
        if($data['users_password'] == $data['users_RePassword']){
            $n = DB::table('users')->where('users_email', $data['email'])->update(['users_password' => md5($data['users_password'])]);
            if($n){
                DB::table('password_reset')->where('email', $data['email'])->delete();
                Alert::success('Đổi mật khẩu thành công');
                return Redirect::to('/login.html')->send();
            }else{
                Alert::error('Mật khẩu không trùng khớp');
                return redirect()->back();
            }
        }else{
            Alert::error('Mật khẩu không trùng khớp');
            return redirect()->back();
        }
        
    }
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

    public function signInUser(Request $request){
        $data = array();
        $data['users_name'] = $request->users_name;
        $data['users_email'] = $request->users_email;

        $all_users = DB::table('users')->orderBy('users_id', 'DESC')->get();
        foreach($all_users as $key => $u){
            if($u->users_email == $data['users_email']){
                Alert::error('Email đã tồn tại');
                return redirect()->back();
            }
        }


        $data['users_password'] = md5($request->users_password);
        $data['users_address'] = $request->users_address;
        $data['users_phone'] = $request->users_phone;
        $data['users_role'] = $request->role;
        $data['active'] = 0;
        $data['token'] = Str::random();

        $get_image = $request->file('user_avatar');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/avatar', $get_name_image);
            $data['users_avatar'] = $get_name_image;

            $n = DB::table('users')->insert($data);
            if($n > 0){
                $users = DB::table('users')->orderBy('users_id', 'DESC')->first();
                $id = $users->users_id;
                if($this->guiMailActive($data['users_email'], $id, $data['token'])){
                    Alert::success('Gửi mail thành công. Vui lòng kiểm tra email để tiến hành kích hoạt tài khoản');
                    return redirect()->back();    
                }
            }else
                Alert::error('Đăng ký thất bại thất bại');
            return redirect()->back();
        }
        $data['users_avatar'] = "unknown.png";
    

        $n = DB::table('users')->insert($data);
        if($n > 0){
            $users = DB::table('users')->orderBy('users_id', 'DESC')->first();
            $id = $users->users_id;
            if($this->guiMailActive($data['users_email'],$id, $data['token'])){
                Alert::success('Gửi mail thành công. Vui lòng kiểm tra email để tiến hành kích hoạt tài khoản');
                return redirect()->back();  
            }
                 
        }
        else
            Alert::error('Đăng ký thất bại');
        return redirect()->back();
    }
    public function activeAccount(){
        $id = $_GET['id'];
        $token = $_GET['token'];
        $users = DB::table('users')->where('users_id', $id)->where('token', $token);
        if($users){
            $count_user = $users->count();
            if($count_user == 0){
                Alert::error('Dữ liệu không hợp lệ');
                return Redirect::to('/login.html')->send();
            }else{
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
}
