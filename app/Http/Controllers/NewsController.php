<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    // frontend // 
    public function danhMucBaiViet(){
        return view('frontend.pages.news.danhMucBaiViet');
    }
    public function hienThiBaiViet(){
        return view('frontend.pages.news.baiViet');
    }

    // backend//
    public function tatCaBaiViet(){
        return view('backend.pages.baiViet.lietKeBaiViet');
    }
    public function themBaiViet(){
        return view('backend.pages.baiViet.themBaiViet');
    }
    public function suaBaiViet(){
        return view('backend.pages.baiViet.suaBaiViet');
    }
}
