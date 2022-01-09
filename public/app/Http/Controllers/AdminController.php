<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
use Auth;
use App\User;
use App\Slider;
use App\Admin;
session_start();

class AdminController extends Controller
{
     
    //backend //

    // Chưa unlink hình khi cập nhật, xóa - Chưa có trường địa chỉ trong cập nhật //

    // Kiểm tra đã đăng nhập hay chưa //
    public function checkLogin(){
        // Lấy id user từ trong session //
        $isLogin = Auth::guard('admin')->check();
        // Nếu id user = null - chưa đăng nhập, return về trang đăng nhập //
        if(!$isLogin)
            return Redirect::to('/admin-login.html')->send();
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
                //Alert::error('Dung lượng ảnh quá lớn');
                var_dump($file_size); exit;
                return -1;
            }
        }
        else{
            //Alert::error('Ảnh không hợp lệ');
            return 0;
        }
        return 1;
    }

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
            $result = $this->checkimg($get_image); // Kiểm tra ảnh có hợp lệ không //
            if($result == -1)
                Alert::error('Dung lượng ảnh quá lớn');
            else if($result == 0)
                Alert::error('Ảnh không hợp lệ');
            else{
                $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
                $get_image->move('public/upload/avatar', $get_name_image); // Di chuyển hình ảnh vào thư mục public //
                $data['users_avatar'] = $get_name_image;

                // Insert data vào db //
                $n = DB::table('users')->insert($data);
                if($n > 0)
                    Alert::success('Thêm user thành công');
                else
                    Alert::error('Thêm user thất bại');
            }
            return redirect()->back();
        }
        // Nếu người dùng không chọn ảnh, gán mặc định bằng unknown.png //
        $data['users_avatar'] = "unknown.png";
    
        // Insert data vào db //
        $n = DB::table('users')->insert($data);
        if($n > 0)
            Alert::success('Thêm user thành công');
        else
            Alert::error('Thêm user thất bại');
        return redirect()->back();
    }
    // Chức năng cập nhập thông tin user //
    public function updateUsers(Request $request,$users_id){
        $data = array();
        // Lấy hình ảnh của user cần cập nhật //
        $avatar = DB::table('users')->where('users_id', $users_id)->get();

        foreach($avatar as $key => $user){
            $data['users_avatar'] = $user->users_avatar;
        }
        
        // Lấy value tên người dùng //
        $data['users_name'] = $request->users_name;
        // Lấy email người dùng //
        $data['users_email'] = $request->users_email;
        // Lấy mật khẩu, mã hóa bằng md5 //
        $data['users_password'] = md5($request->users_password);
        // Lấy sđt người dùng //
        $data['users_phone'] = $request->users_phone;
        // Lấy địa chỉ người dùng //
        $data['users_address'] = $request->users_address; 
        // Lấy role của người dùng //
        $data['users_role'] = $request->role;

        // Lấy hình ảnh //
        $get_image = $request->file('user_avatar');

        // Kiểm tra nếu người dùng có chọn ảnh //
        if($get_image){
            $result = $this->checkimg($get_image); // Kiểm tra ảnh có hợp lệ không //
            if($result == -1)
                Alert::error('Dung lượng ảnh quá lớn');
            else if($result == 0)
                Alert::error('Ảnh không hợp lệ');
            else{
                // unlink hình trong public //
                if($data['users_avatar'] != 'unknown.png')
                    unlink('public/upload/avatar/'.$data['users_avatar']);
                $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
                $get_image->move('public/upload/avatar', $get_name_image);// Di chuyển hình ảnh vào thư mục public //
                $data['users_avatar'] = $get_name_image;

                // update data vào db //
                DB::table('users')->where('users_id', $users_id)->update($data);
                //Session::put('message', 'Thêm thành công');
                Alert::success('Cập nhật thành công');
            }
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
        // unlink hình trong public //
        $avatar = DB::table('users')->where('users_id', $users_id)->get();
        foreach($avatar as $key => $user){
            $hinh = $user->users_avatar;
        }
        if($hinh != 'unknown.png')
            unlink('public/upload/avatar/'.$hinh);
        // Xóa user trong db //
        $n = DB::table('users')->where('users_id',$users_id)->delete();
        if($n > 0)
            Alert::success('Xóa thành công');
        else
            Alert::error('Xóa thất bại');
        return Redirect::to('/liet-ke-user.html');
    }

    // Liệt kê các hình slider //
    public function lietKeSlider(){
        $this->checkLogin();
        $all_slider = Slider::orderBy('maSlider', 'DESC')->get();

        return view('backend.pages.slider.lietKeSlider')->with('all_slider', $all_slider);
    }

    // Trang thêm slider của admin //
    public function themSlider(){
        return view('backend.pages.slider.themSlider');
    }
    // Thêm hình ảnh slider vào db // 
    public function createSlider(Request $request){

        $this->checkLogin();
        // Tạo đối tượng slider từ model //
        $slider = new Slider();
        $slider->tenSlider = $request->slider_name;
        $slider->moTa = $request->slider_desc;
        $slider->trangThai = $request->slider_status;

        // Lấy hình ảnh người dùng chọn //
        $get_image = $request->file('slider_img');
        // Nếu người dùng có chọn hình và hình ảnh hợp lệ //
        var_dump($get_image); exit;
        if($get_image){
            $result = $this->checkimg($get_image); // Kiểm tra ảnh có hợp lệ không //
            if($result == -1)
                Alert::error('Dung lượng ảnh quá lớn');
            else if($result == 0)
                Alert::error('Ảnh không hợp lệ');
            else{
                $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
                $get_image->move('public/upload/slider', $get_name_image); // Di chuyển hình vào public 
                $slider->hinhAnh = $get_name_image;

                // Lưu hình ảnh vào db //
                $slider->save();
                Alert::success('Thêm thành công');
            }
            return Redirect::to('/liet-ke-slider.html');
        }else
            Alert::error('Vui lòng chọn hình ảnh');
        return Redirect::to('/liet-ke-slider.html');

    }
    // Xóa slider trong db //
    public function deleteSlider($slide_id){
        // Lấy hình ảnh trong db cần xóa, dựa vào mã //
        $slide = Slider::find($slide_id); 
        // Xóa hình ảnh trong public //
        unlink('public/upload/slider/'.$slide->hinhAnh);
        // Xóa hình ảnh trong db //
        Slider::where('maSlider', $slide_id)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }


}