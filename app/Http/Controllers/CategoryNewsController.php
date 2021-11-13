<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryNewsController extends Controller
{
    public function lietKeDanhMucBaiViet(){
        return view('backend.pages.danhMucBaiViet.lietKeDanhMucBaiViet');
    }
    public function themDanhMucBaiViet(){
        return view('backend.pages.danhMucBaiViet.themDanhMucBaiViet');
    }
    public function suaDanhMucBaiViet(){
        return view('backend.pages.danhMucBaiViet.suaDanhMucBaiViet');
    }
}
