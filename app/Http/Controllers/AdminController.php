<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function themUser(){
        return view('backend.pages.user.themUser');
    }
    public function lietKeDanhMucSanPham(){
        return view('backend.pages.danhMucSanPham.lietKeDanhMucSanPham');
    }

}
