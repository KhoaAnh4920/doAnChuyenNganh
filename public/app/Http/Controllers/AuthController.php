<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Admin;
use Session;
use Redirect;
use DB;
use Alert;
session_start();


class AuthController extends Controller
{
    // Chức năng đăng nhập user //
    public function loginUser(Request $request){
        $this->validate($request, [
            'user_email'   => 'required|email|max:255', 
            'user_password' => 'required|min:6|max:255'
        ]);
        if (Auth::guard('user')->attempt(['users_email' => $request->user_email, 'users_password' => $request->user_password])) {

            return Redirect::to('/trang-chu.html');
        }else{
            Alert::error('Email hoặc mật khẩu sai');
            return Redirect::to('/login.html');
        }
        
    }
    // Đăng xuất cho user //
    public function logoutUser(){
        Auth::guard('user')->logout(); 
        return Redirect::to('/trang-chu.html');
    }
    // Chức năng đăng nhập admin //
    public function loginAdmin(Request $request){
        $this->validate($request, [
            'adminEmail'   => 'required|email|max:255', 
            'adminPass' => 'required|min:6|max:255'
        ]);

        if (Auth::guard('admin')->attempt(['users_email' => $request->adminEmail, 'users_password' => $request->adminPass])) {
            return Redirect::to('/admin');
        }else{
            Alert::error('Email hoặc mật khẩu sai');
            return Redirect::to('/admin-login.html');
        }
    }
    // Đăng xuất cho admin
    public function logoutAdmin(){

        Auth::guard('admin')->logout(); 
        return Redirect::to('/admin-login.html');
    }
}
