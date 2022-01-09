<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
session_start();

class AdminController extends Controller
{
    
    //backend //

    // Chưa unlink hình khi cập nhật, xóa - Chưa có trường địa chỉ trong cập nhật //

    // Trả về trang index của admin //
    public function adminPage(){
        $this->checkLogin();
        return view('backend.pages.topPages.home');
    }
    // Trả về trang đăng nhập của admin //
    public function adminLogin(){
        return view('backend.pages.loginAdmin.login');
    }
    // Chức năng liệt kê user //
    public function lietKeUser(){
        // Kiểm tra người dùng đã có đăng nhập // 
        $this->checkLogin();
        // Lấy dữ liệu của tất cả users trong db // 
        $all_users = DB::table('users')->orderby('users_id')->get();
        return view('backend.pages.user.lietKeUser')->with('all_users', $all_users);
    }
    // Chức năng sửa thông tin users
    public function suaUser($users_id){
        // Kiểm tra người dùng đã có đăng nhập // 
        $this->checkLogin();
        // Lấy thông tin users cần sửa thông tin // 
        $edit_users = DB::table('users')->where('users_id', $users_id)->get();
        return view('backend.pages.user.suaUser')->with('edit_users', $edit_users);
    }
    // Chức năng thêm users
    public function themUser(){
        // Kiểm tra người dùng đã có đăng nhập // 
        $this->checkLogin();
        return view('backend.pages.user.themUser');
    }
    


    // Chức năng đăng nhập admin //
    public function loginAdmin(Request $request){
        // Lấy value email người dùng nhập //
        $users_email = $request->adminEmail;
        // Lấy value password người dùng nhập //
        $users_password = md5($request->adminPass);

        // regex kiểm tra email hợp lệ //
        $attern_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        // regex kiểm tra mật khẩu hợp lệ
        $attern_password = "/^[a-zA-Z-' ]*$/";
        // kiểm tra email và password có hợp lệ //
        if(preg_match($attern_email, $users_email) && !preg_match($attern_password, $users_password)  ){
            // Lấy thông tin admin //
            $result = DB::table('users')->where('users_email',$users_email)->where('users_password',$users_password)->first();
            
            // Nếu tồn tại admin, lưu hình ảnh, tên, id vào session //
            if($result){
         
            Session::put('admin_avatar', $result->users_avatar);
            Session::put('admin_name', $result->users_name);
            
            Session::put('admin_id', $result->users_id);
            return Redirect::to('/admin');
            } // Email hoặc mật khẩu không hợp lệ //
            else{
                Session::put('message', 'Email hoặc mật khẩu sai');
                return Redirect::to('/admin-login.html');
            }
        } // Dữ liệu không đúng định dạng
        else{
                Session::put('message', 'Dữ liệu không đúng định dạng');
                return Redirect::to('/admin-login.html');
        }
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
    // Kiểm tra đã đăng nhập hay chưa //
    public function checkLogin(){
        // Lấy id user từ trong session //
        $user_id = Session::get('admin_id');
        // Nếu id user = null - chưa đăng nhập, return về trang đăng nhập //
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
    // Đăng xuất cho user //
    public function logoutUser(){

        Session::put('user_name', null);
        Session::put('user_id', null);
        return Redirect::to('/trang-chu.html');
    }
    // Đăng xuất cho admin
    public function logoutAdmin(){

        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin-login.html');
    }
    // Chức năng thêm người dùng vào db // 
    public function createUsers(Request $request){
        $data = array();
        // Lấy value tên người dùng //
        $data['users_name'] = $request->users_name;
        // Lấy email người dùng //
        $data['users_email'] = $request->users_email;

        // Kiểm tra người dùng đã tồn tại trong hệ thống hay chưa //
        $all_users = DB::table('users')->orderBy('users_id', 'DESC')->get();
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
        $data['active'] = 1;

        // Lấy hình ảnh //
        $get_image = $request->file('user_avatar');

        //Kiểm tra nếu người dùng có chọn ảnh //
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/avatar', $get_name_image); // Di chuyển hình ảnh vào thư mục public //
            $data['users_avatar'] = $get_name_image;

            // Insert data vào db //
            $n = DB::table('users')->insert($data);
            if($n > 0)
                Alert::success('Tạo thành công');
            else
                Alert::error('Tạo thất bại');
            //Session::put('message', 'Đăng ký thành công');
            return redirect()->back();
        }
        // Nếu người dùng không chọn ảnh, gán mặc định bằng unknown.png //
        $data['users_avatar'] = "unknown.png";
    
        // Insert data vào db //
        $n = DB::table('users')->insert($data);
        if($n > 0)
            Alert::success('Tạo thành công');
        else
            Alert::error('Tạo thất bại');
        return redirect()->back();
    }
    // Chức năng cập nhập thông tin user //
    public function updateUsers(Request $request,$users_id){
        // Lấy hình ảnh của user cần cập nhật //
        $avatar = DB::table('users')->where('users_id', $users_id)->get();

        foreach($avatar as $key => $user){
            $data['users_avatar'] = $user->users_avatar;
        }
              
        // var_dump($avatar); exit;
        $data = array();
        // Lấy value tên người dùng //
        $data['users_name'] = $request->users_name;
        // Lấy email người dùng //
        $data['users_email'] = $request->users_email;
        // Lấy mật khẩu, mã hóa bằng md5 //
        $data['users_password'] = $request->users_password;
        // Lấy sđt người dùng //
        $data['users_phone'] = $request->users_phone;
        // Lấy địa chỉ người dùng //
        $data['users_address'] = $request->users_address;
        // Lấy role của người dùng //
        $data['users_role'] = $request->role;

        // Lấy hình ảnh //
        $get_image = $request->file('user_avatar');

        //Kiểm tra nếu người dùng có chọn ảnh //
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/avatar', $get_name_image);// Di chuyển hình ảnh vào thư mục public //
            $data['users_avatar'] = $get_name_image;

            // update data vào db //
            DB::table('users')->where('users_id', $users_id)->update($data);
            //Session::put('message', 'Thêm thành công');
            Alert::success('Cập nhật thành công');
            return Redirect::to('/liet-ke-user.html');
        }

        
        $n = DB::table('users')->where('users_id', $users_id)->update($data);
        //Session::put('message', 'Cập nhật thành công');
        if($n > 0)
            Alert::success('Cập nhật thành công');
        else
            Alert::error('Cập nhật thất bại');
        return Redirect::to('/liet-ke-user.html');
    }

    // Chức năng xóa user //
    public function deleteUsers($users_id){
        // Xóa user trong db //
        $n = DB::table('users')->where('users_id',$users_id)->delete();
        if($n > 0)
            Alert::success('Xóa thành công');
        else
            Alert::error('Xóa thất bại');
        return Redirect::to('/liet-ke-user.html');
    }


}