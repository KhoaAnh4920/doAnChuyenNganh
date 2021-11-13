<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    // frontend //
    public function Categoryproduct(){
        return view('frontend.pages.productsPages.categoryProduct');
    }


    // backend //
    public function lietKeDanhMucSanPham(){
        return view('backend.pages.danhMucSanPham.lietKeDanhMucSanPham');
    }
    public function themDanhMucSanPham(){
        return view('backend.pages.danhMucSanPham.themDanhMucSanPham');
    }
    public function suaDanhMucSanPham(){
        return view('backend.pages.danhMucSanPham.suaDanhMucSanPham');
    }
}
