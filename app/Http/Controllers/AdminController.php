<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;

class AdminController extends Controller
{
    
    //backend //

    public function adminPage(){
        return view('backend.pages.topPages.home');
    }
    public function adminLogin(){
        return view('backend.pages.loginAdmin.login');
    }
    public function lietKeUser(){
        return view('backend.pages.user.lietKeUser');
    }
    public function suaUser(){
        return view('backend.pages.user.suaUser');
    }
    public function themUser(){
        return view('backend.pages.user.themUser');
    }


    


    public function lietKeDonHang(){
        return view('backend.pages.donHang.lietKeDonHang');
    }
    public function chiTietDonHang(){
        return view('backend.pages.donHang.lietKeChiTietDonHang');
    }
    public function suaKhachHang(){
        return view('backend.pages.donHang.suaKhachHang');
    }
    public function suaChiTietDonHang(){
        return view('backend.pages.donHang.suaChiTietDonHang');
    }



    

    public function dashboard(Request $request){

        $admin_email = $request->adminEmail;
        $admin_password = md5($request->adminPass);
        
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
           Session::put('admin_name', $result->admin_name);
           Session::put('admin_id', $result->admin_id);
           return Redirect::to('/admin');
        }
        else{
            Session::put('message', 'Email hoặc mật khẩu sai');
            return Redirect::to('/admin-login.html');
        }
    }

}
