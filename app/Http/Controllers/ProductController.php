<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Frontend //
    public function product(){
        return view('frontend.pages.productsPages.product');
    }
    public function productDetails(){
        return view('frontend.pages.productsPages.productDetails');
    }


    // Backend
    public function lietKeSanPham(){
        return view('backend.pages.sanPham.lietKeSanPham');
    }
    public function themSanPham(){
        return view('backend.pages.sanPham.themSanPham');
    }
    public function suaSanPham(){
        return view('backend.pages.sanPham.suaSanPham');
    }
}
