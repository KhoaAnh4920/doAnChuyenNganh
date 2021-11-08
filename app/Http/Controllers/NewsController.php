<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function danhMucBaiViet(){
        return view('frontend.pages.news.danhMucBaiViet');
    }
    public function hienThiBaiViet(){
        return view('frontend.pages.news.baiViet');
    }
}
