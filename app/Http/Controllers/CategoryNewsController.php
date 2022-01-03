<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
use App\CateNews;
use View;
session_start();

class CategoryNewsController extends Controller
{
    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
    public function lietKeDanhMucBaiViet(){
        $this->checkLogin();
        $cate_news = CateNews::orderBy('maDanhMuc')->get();
        return view('backend.pages.danhMucBaiViet.lietKeDanhMucBaiViet')->with('cate_news', $cate_news);
    }
    public function themDanhMucBaiViet(){
        $this->checkLogin();
        return view('backend.pages.danhMucBaiViet.themDanhMucBaiViet');
    }
    public function suaDanhMucBaiViet($cate_id){
        $this->checkLogin();
        $edit_cate_news = CateNews::find($cate_id);
        return view('backend.pages.danhMucBaiViet.suaDanhMucBaiViet')->with('edit_cate_news', $edit_cate_news);
    }
    public function createCategory(Request $request){
        $this->checkLogin();
        $data = array();
        $cateNews = new CateNews();
        $cateNews->tenDanhMuc = $request->tenDanhMucBaiViet;
        $cateNews->slug = $request->slug_danhMucBaiViet;
        $cateNews->moTa = $request->moTaDanhMucBaiViet;
        $n = $cateNews->save();
        if($n)
            Alert::success('Thêm thành công');
        else
            Alert::error('Thêm thất bại');
        return Redirect::to('/liet-ke-danh-muc-bai-viet.html');
    }
    public function updateCategory(Request $request, $cate_id){
        $this->checkLogin();
        $cateNews = CateNews::find($cate_id);
        $cateNews->tenDanhMuc = $request->tenDanhMucBaiViet;
        $cateNews->slug = $request->slug_danhMucBaiViet;
        $cateNews->moTa = $request->moTaDanhMucBaiViet;
        $n = $cateNews->save();
        if($n)
            Alert::success('Cập nhật thành công');
        else
            Alert::error('Cập nhật thất bại');
        return Redirect::to('/liet-ke-danh-muc-bai-viet.html');
    }
    public function xoaDanhMucBaiViet($cate_id){
        $this->checkLogin();

        // Ràng buộc //
        $sl_baiViet= CateNews::leftJoin("baiviet", function($join){
            $join->on("danhmucbaiviet.madanhmuc", "=", "baiviet.madanhmuc");})
            ->select("danhmucbaiviet.tendanhmuc", DB::raw("count(baiviet.maBaiViet) as sl"))
            ->where("danhmucbaiviet.maDanhMuc", $cate_id)
            ->groupBy("danhmucbaiviet.maDanhMuc")
            ->get();
        if($sl_baiViet > 0){
            Alert::error('Không thể xóa danh mục đã có bài viết');
        }else{
            $n = CateNews::where('maDanhMuc', $cate_id)->delete();
            if($n)
                Alert::success('Xóa thành công');
            else
                Alert::error('Xóa thất bại');
        }
        
        
    }
}