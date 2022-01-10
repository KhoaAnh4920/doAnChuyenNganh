<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
use App\CateNews;
use View;
use Auth;
use App\User;
use App\Admin;
session_start();

class CategoryNewsController extends Controller
{
    // Kiểm tra đã đăng nhập hay chưa //
    public function checkLogin(){
        // Lấy id user từ trong session //
        $isLogin = Auth::guard('admin')->check();
        // Nếu id user = null - chưa đăng nhập, return về trang đăng nhập //
        if(!$isLogin)
            return Redirect::to('/admin-login.html')->send();
    }
    // Trang liệt kê danh mục bài viết //
    public function lietKeDanhMucBaiViet(){
        $this->checkLogin();
        $cate_news = CateNews::orderBy('maDanhMuc')->get();
        return view('backend.pages.danhMucBaiViet.lietKeDanhMucBaiViet')->with('cate_news', $cate_news);
    }
    // Trang thêm danh mục bài viết //
    public function themDanhMucBaiViet(){
        $this->checkLogin();
        return view('backend.pages.danhMucBaiViet.themDanhMucBaiViet');
    }
    // Trang sửa danh mục bài viết //
    public function suaDanhMucBaiViet($cate_id){
        $this->checkLogin();
        $edit_cate_news = CateNews::find($cate_id);
        return view('backend.pages.danhMucBaiViet.suaDanhMucBaiViet')->with('edit_cate_news', $edit_cate_news);
    }
    // xử lý thêm danh mục bài viết //
    public function createCategory(Request $request){
        $this->checkLogin();
        $data = array();
        // Tạo đối tượng cate news //
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
    // Xử lý cập nhật danh mục bài viết //
    public function updateCategory(Request $request, $cate_id){
        $this->checkLogin();
        // Lấy thông tin bài viết cần cập nhật dựa vào $cate_id //
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
    // Xử lý xóa danh mục bài viết //
    public function xoaDanhMucBaiViet($cate_id){
        $this->checkLogin();

        // Ràng buộc nếu danh mục đã có bài viết thì không được xóa //
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