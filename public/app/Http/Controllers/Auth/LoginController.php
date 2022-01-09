<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
session_start();

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    // Chức năng đăng nhập cho user // 
    public function loginUser(Request $request){
        // Lấy value email người dùng nhập //
        $user_email = $request->user_email;
        // Lấy value password người dùng nhập //
        $user_password = md5($request->user_password);

        // regex kiểm tra email hợp lệ //
        $attern_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        // regex kiểm tra mật khẩu hợp lệ
        $attern_password = "/^[a-zA-Z-' ]*$/";
        // kiểm tra email và password có hợp lệ //
        if(preg_match($attern_email, $user_email) && !preg_match($attern_password, $user_password)  ){
            // Lấy thông tin user //
            $result = DB::table('users')->where('users_email',$user_email)->where('users_password',$user_password)->first();

            // Nếu tồn tại user, lưu hình ảnh, tên, id vào session //
            if($result){
            Session::put('user_avatar', $result->users_avatar);
            Session::put('user_name', $result->users_name);
            
            Session::put('user_id', $result->users_id);

            return Redirect::to('/trang-chu.html');
            }// Email hoặc mật khẩu không hợp lệ //
            else{
                Session::put('message_login', 'Email hoặc mật khẩu sai');
                return Redirect::to('/login.html');
            }
        }// Dữ liệu không đúng định dạng
        else{
                Session::put('message_login', 'Dữ liệu không đúng định dạng');
                return Redirect::to('/login.html');
        }
    }
}
