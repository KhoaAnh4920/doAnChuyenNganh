<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
session_start();

class CategoryNewsController extends Controller
{
    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
    public function lietKeDanhMucBaiViet(){
        $this->checkLogin();
        return view('backend.pages.danhMucBaiViet.lietKeDanhMucBaiViet');
    }
    public function themDanhMucBaiViet(){
        $this->checkLogin();
        return view('backend.pages.danhMucBaiViet.themDanhMucBaiViet');
    }
    public function suaDanhMucBaiViet(){
        $this->checkLogin();
        return view('backend.pages.danhMucBaiViet.suaDanhMucBaiViet');
    }
}
