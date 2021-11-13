<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function lietKeThuongHieu(){
        return view('backend.pages.danhMucThuongHieu.lietKeThuongHieu');
    }
    public function themThuongHieu(){
        return view('backend.pages.danhMucThuongHieu.themThuongHieu');
    }
    public function suaThuongHieu(){
        return view('backend.pages.danhMucThuongHieu.suaThuongHieu');
    }

}
