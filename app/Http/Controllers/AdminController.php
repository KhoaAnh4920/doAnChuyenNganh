<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
session_start();

class AdminController extends Controller
{
    
    //backend //

    public function adminPage(){
        $this->checkLogin();
        return view('backend.pages.topPages.home');
    }
    public function adminLogin(){
        return view('backend.pages.loginAdmin.login');
    }
    public function lietKeUser(){
        $this->checkLogin();
        $all_users = DB::table('users')->orderby('users_id')->get();
        return view('backend.pages.user.lietKeUser')->with('all_users', $all_users);
    }
    public function suaUser($users_id){
        $this->checkLogin();
        $edit_users = DB::table('users')->where('users_id', $users_id)->get();
        return view('backend.pages.user.suaUser')->with('edit_users', $edit_users);
    }
    public function themUser(){
        $this->checkLogin();
        return view('backend.pages.user.themUser');
    }
    



    public function loginAdmin(Request $request){

        $users_email = $request->adminEmail;
        $users_password = md5($request->adminPass);

        

        $attern_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        $attern_password = "/^[a-zA-Z-' ]*$/";
        if(preg_match($attern_email, $users_email) && !preg_match($attern_password, $users_password)  ){
            $result = DB::table('users')->where('users_email',$users_email)->where('users_password',$users_password)->first();
            
            if($result){
         
            Session::put('admin_avatar', $result->users_avatar);
            Session::put('admin_name', $result->users_name);
            
            Session::put('admin_id', $result->users_id);
            return Redirect::to('/admin');
            }
            else{
                Session::put('message', 'Email hoặc mật khẩu sai');
                return Redirect::to('/admin-login.html');
            }
        }
        else{
                Session::put('message', 'Dữ liệu không đúng định dạng');
                return Redirect::to('/admin-login.html');
        }
    }
    public function loginUser(Request $request){

        $user_email = $request->user_email;
        $user_password = md5($request->user_password);


        $attern_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        $attern_password = "/^[a-zA-Z-' ]*$/";
        if(preg_match($attern_email, $user_email) && !preg_match($attern_password, $user_password)  ){
            $result = DB::table('users')->where('users_email',$user_email)->where('users_password',$user_password)->first();
            if($result){
            Session::put('user_avatar', $result->users_avatar);
            Session::put('user_name', $result->users_name);
            
            Session::put('user_id', $result->users_id);

            return Redirect::to('/trang-chu.html');
            }
            else{
                Session::put('message_login', 'Email hoặc mật khẩu sai');
                return Redirect::to('/login.html');
            }
        }
        else{
                Session::put('message_login', 'Dữ liệu không đúng định dạng');
                return Redirect::to('/login.html');
        }
    }

    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }

    public function logoutUser(){

        Session::put('user_name', null);
        Session::put('user_id', null);
        return Redirect::to('/trang-chu.html');
    }
    public function logoutAdmin(){

        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin-login.html');
    }

    public function createUsers(Request $request){
        $data = array();
        $data['users_name'] = $request->users_name;
        $data['users_email'] = $request->users_email;
        $data['users_password'] = md5($request->users_password);
        $data['users_address'] = $request->users_address;
        $data['users_phone'] = $request->users_phone;
        $data['users_role'] = $request->role;

        $get_image = $request->file('user_avatar');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/avatar', $get_name_image);
            $data['users_avatar'] = $get_name_image;

            DB::table('users')->insert($data);
            Session::put('message', 'Đăng ký thành công');
            return redirect()->back()->with('error_code', 5);
        }
        $data['users_avatar'] = "unknown.png";
    

        DB::table('users')->insert($data);
        Session::put('message', 'Đăng ký thành công');
        return redirect()->back()->with('error_code', 5);
    }
    public function updateUsers(Request $request,$users_id){
        $avatar = DB::table('users')->where('users_id', $users_id)->get();

        foreach($avatar as $key => $user){
            $data['users_avatar'] = $user->users_avatar;
        }
              
        // var_dump($avatar); exit;
        $data = array();
        $data['users_name'] = $request->users_name;
        $data['users_email'] = $request->users_email;
        $data['users_password'] = $request->users_password;
        $data['users_phone'] = $request->users_phone;
        $data['users_role'] = $request->role;

        $get_image = $request->file('user_avatar');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/avatar', $get_name_image);
            $data['users_avatar'] = $get_name_image;

            DB::table('users')->where('users_id', $users_id)->update($data);
            Session::put('message', 'Thêm thành công');
            return Redirect::to('/liet-ke-user.html')->with('error_code', 5);
        }

        
        DB::table('users')->where('users_id', $users_id)->update($data);
        Session::put('message', 'Cập nhật thành công');
        return Redirect::to('/liet-ke-user.html')->with('error_code', 5);
    }

    public function deleteUsers($users_id){
        DB::table('users')->where('users_id',$users_id)->delete();
        Session::put('message','Xóa user thành công');
        return Redirect::to('/liet-ke-user.html')->with('error_code', 5);
    }


}
