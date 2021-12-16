<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
session_start();

class NewsController extends Controller
{
    // frontend // 
    public function danhMucBaiViet(){
        $all_brands = DB::table("thuonghieu")
        ->leftJoin("dbsanpham", function($join){
            $join->on("thuonghieu.mathuonghieu", "=", "dbsanpham.mathuonghieu");
        })
        ->select("thuonghieu.*", DB::raw('count(dbsanpham.masanpham) as sl'))
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();

        $all_category_products = DB::table('danhmucsanpham')->orderby('maDanhMuc')->get();

        // Đếm số lượng danh mục con của từng danh mục cha //
        $count_danhMucCon = DB::table('danhmucsanpham')
        ->select( "danhmucsanpham.maDanhMuc as maDanhMucCha","danhmucsanpham.tenDanhMuc","danhmucsanpham.slug",DB::raw('(select count(*) from danhmucsanpham where danhmucsanpham.danhMucCha = maDanhMucCha) as SL'))
        ->where('danhmucsanpham.danhMucCha', 0)
        ->get();
        
        return view('frontend.pages.news.danhMucBaiViet')->with('all_brands', $all_brands)
        ->with('all_category_products', $all_category_products)
       
        ->with('count_danhMucCon', $count_danhMucCon);;
    }
    public function hienThiBaiViet(){
        return view('frontend.pages.news.baiViet');
    }

    // backend//
    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
    public function tatCaBaiViet(){
        $this->checkLogin();
        return view('backend.pages.baiViet.lietKeBaiViet');
    }
    public function themBaiViet(){
        $this->checkLogin();
        return view('backend.pages.baiViet.themBaiViet');
    }
    public function suaBaiViet(){
        $this->checkLogin();
        return view('backend.pages.baiViet.suaBaiViet');
    }
}
