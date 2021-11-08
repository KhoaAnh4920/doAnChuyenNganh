<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // front end // 
    public function index(){
        return view('frontend.pages.topPages.index');
    }
    public function cart(){
        return view('frontend.pages.orderPages.cart');
    }
    public function checkout(){
        return view('frontend.pages.orderPages.checkout');
    }
    public function product(){
        return view('frontend.pages.productsPages.product');
    }
    public function productDetails(){
        return view('frontend.pages.productsPages.productDetails');
    }
    public function Categoryproduct(){
        return view('frontend.pages.productsPages.categoryProduct');
    }
    public function login(){
        return view('frontend.pages.loginUserPages.login');
    }
    public function contact(){
        return view('frontend.pages.contactPages.contact');
    }
    
    



}
