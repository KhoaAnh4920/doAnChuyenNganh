<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class galleryController extends Controller
{
    public function lietKeDanhMucHinh(){
        return view('backend.pages.danhMucHinhSanPham.lietKeDanhMucHinh');
    }
    public function themDanhMucHinh(){
        return view('backend.pages.danhMucHinhSanPham.themDanhMucHinh');
    }
    public function suaDanhMucHinh(){
        return view('backend.pages.danhMucHinhSanPham.suaDanhMucHinh');
    }
}
