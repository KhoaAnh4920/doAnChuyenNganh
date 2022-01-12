<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
use View;
use App\CateNews;
use App\News;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Admin;
session_start();

class NewsController extends Controller
{
    // frontend // 
    // Hiển thị trang tin tức dựa vào slug là tenDanhMuc //
    public function danhMucBaiViet($tenDanhMuc){

        // Lấy ra danh mục bài viết //
        $cate_news = CateNews::orderBy('maDanhMuc')->take(3)->get();
        // Lấy bài viết dựa vào tenDanhMuc - mặc định khi click vào trang tin tức thì slug là tin-moi-nhat //
        if($tenDanhMuc == 'tin-moi-nhat'){
            $tintuc = News::orderBy('maBaiViet', 'DESC')->get();
        }else{
            $cate_id = CateNews::where('slug', $tenDanhMuc)->first();
            $id = $cate_id->maDanhMuc;
            $tintuc = News::where('maDanhMuc', $id)->orderBy('maBaiViet', 'DESC')->get();
        }

        $tinKhuyenMai = News::where('maDanhMuc', 4)->orderBy('maBaiViet', 'DESC')->get();
        
        return view('frontend.pages.news.danhMucBaiViet')
        ->with('cate_news', $cate_news)
        ->with('tintuc', $tintuc)
        ->with('slug', $tenDanhMuc)
        ->with('khuyenMai', $tinKhuyenMai);
    }
    // Trang hiển thị chi tiết bài viết //
    public function hienThiBaiViet($news_slug){

        // Lấy chi tiết bài viết dựa vào news_slug //
        $news = News::join("users", function($join){
            $join->on("users.users_id", "=", "baiviet.users_id");
        })
        ->select("baiviet.*", "users.users_name")
        ->where('slug', $news_slug)->first(); 

        $maDanhMuc = $news->maDanhMuc;
        $maBaiViet = $news->maBaiViet;
        $tinLienQuan = News::where('maDanhMuc', $maDanhMuc)->where('maBaiViet', '<>', $maBaiViet)->orderBy('maBaiViet', 'DESC')->take(3)->get();

        return view('frontend.pages.news.baiViet')
        ->with('news', $news)
        ->with('tinLienQuan', $tinLienQuan);
    }

    // backend//
    // Kiểm tra đã đăng nhập hay chưa //
    public function checkLogin(){
        // Check người dùng đã đăng nhập chưa //
        $isLogin = Auth::guard('admin')->check();
        // Nếu isLogin khác true - chưa đăng nhập, return về trang đăng nhập //
        if(!$isLogin)
            return Redirect::to('/admin-login.html')->send();
    }
    // Trang liệt kê tất cả bài viết //
    public function tatCaBaiViet(){
        $this->checkLogin();
        $all_news = News::join("danhmucbaiviet", function($join){
            $join->on("danhmucbaiviet.madanhmuc", "=", "baiviet.madanhmuc");
        })
        ->join("users", function($join){
            $join->on("users.users_id", "=", "baiviet.users_id");
        })
        ->select("baiviet.*", "danhmucbaiviet.tenDanhMuc", "users.users_name")
        ->paginate(10);
        return view('backend.pages.baiViet.lietKeBaiViet')->with('all_news', $all_news);
    }
    // Trang thêm bài viết //
    public function themBaiViet(){
        $this->checkLogin();
        $all_category_news = CateNews::orderBy('maDanhMuc')->get();
        return view('backend.pages.baiViet.themBaiViet')->with('all_category_news', $all_category_news);
    }
    // Trang sửa bài viết //
    public function suaBaiViet($news_id){
        $this->checkLogin();
        $edit_news = News::find($news_id);
        $all_category_news = CateNews::orderBy('maDanhMuc')->get();
        return view('backend.pages.baiViet.suaBaiViet')->with('edit_news', $edit_news)->with('all_category_news', $all_category_news);
    }
    // Kiểm tra hình có hợp lệ //
    public function checkimg($h){
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
        // Dung lượng hình tối đa là 2MB
        $maxsize = 2 * 1024 * 1024;
        $file_name = $h->getClientOriginalName(); // Lấy tên hình //
        $file_size = $h->getSize(); // Lấy dung lượng hình //
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);  // Lấy đuôi hình //

        // Check đuôi mở rộng hình có hợp lệ hay không //
        if(in_array(strtolower($file_ext), $allowed_types)) {
            // Check dung lượng hình - 2MB max
            if ($file_size > $maxsize) {
                Alert::error('Dung lượng ảnh quá lớn');
                return false;
            }
        }
        else{
            Alert::error('Ảnh không hợp lệ');
            return false;
        }
        return true;
    }
    // Xử lý thêm bài viết //
    public function createNews(Request $request){
        $this->checkLogin();
        // Lấy id của tác giả //
        $user_id = Auth::guard('admin')->user()->users_id; 
        $news = new News();
        $news->tieuDe = $request->tieuDeBaiViet;
        $news->slug = $request->slug_BaiViet;
        $news->moTa = $request->moTaBaiViet;
        $news->noiDung = $request->noiDungBaiViet;
        $news->maDanhMuc = $request->danhMucBaiViet;
        $news->trangThai = $request->trangThai;
        $news->users_id = $user_id;
        $dt = Carbon::now('Asia/Ho_Chi_Minh'); // Lấy thời gian hiện tại //

        $news->created_at = $dt->toDateTimeString();
        // Lấy hình ảnh //
        $get_image = $request->file('hinhAnh');
        // Nếu người dùng có chọn hình và hình ảnh hợp lệ //
        if($get_image && $this->checkimg($get_image)){ 
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/news', $get_name_image); // Di chuyển hình vào public 
            $news->hinhAnh = $get_name_image;

        }
        $n = $news->save(); // insert vào db //
        if($n)
            Alert::success('Thêm thành công');
        else
            Alert::error('Thêm thất bại');
        return Redirect::to('/liet-ke-bai-viet.html');
    }
    // Xử lý cập nhật bài viết //
    public function updateNews(Request $request, $new_id){
        $this->checkLogin();
        // Lấy id của tác giả //
        $user_id = Auth::guard('admin')->user()->users_id;
        // Lấy thông tin bài viết cần cập nhật //
        $news = News::find($new_id);
        $news->tieuDe = $request->tieuDeBaiViet;
        $news->slug = $request->slug_BaiViet;
        $news->moTa = $request->moTaBaiViet;
        $news->noiDung = $request->noiDungBaiViet;
        $news->maDanhMuc = $request->danhMucBaiViet;
        $news->trangThai = $request->trangThai;
        $news->users_id = $user_id;
        $dt = Carbon::now('Asia/Ho_Chi_Minh'); 
        $news->updated_at = $dt->toDateTimeString();

        $get_image = $request->file('hinhAnh');
        if($get_image && $this->checkimg($get_image)){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            //$get_image->move('public/upload/news', $get_name_image);
            $news->hinhAnh = $get_name_image;

        }
        $n = $news->save();
        if($n)
            Alert::success('Cập nhật thành công');
        else
            Alert::error('Cập nhật thất bại');
        return Redirect::to('/liet-ke-bai-viet.html');
    }
    // Xóa bài viết //
    public function xoaBaiViet($news_id){
        // Lấy hình ảnh bài viết cần xóa //
        $news = News::find($new_id);
        $hinhAnh = $news['hinhAnh'];
        unlink('public/upload/news/'.$hinhAnh); // Xóa hình ảnh trong thư mục public //
        $n = News::where('maBaiViet', $news_id)->delete(); // Xóa bài viết trong db //
        if($n)
            Alert::success('Xóa thành công');
        else
            Alert::error('Xóa thất bại');
        return Redirect::to('/liet-ke-bai-viet.html');
    }

    // Xử lý load more bài viết //
    public function load_more_news(Request $request){

        $data = $request->all();
        
        // Click vào load more //
        if($data['id'] > 0){
            if($data['slug'] == 'tin-moi-nhat'){
                // Lấy bài viết theo thứ tự mã giảm dần, từ tên xuống, mặc định lấy 6 bài viết 1 lần click //
                $tintucMoi = News::where('trangThai', '1')->where('maBaiViet', '<', $data['id'])->orderby('maBaiViet', 'DESC')->take(6)->get();
            }else{
                // Lấy id của danh mục bài viết //
                $cate_id = CateNews::where('slug', $data['slug'])->first();
                $id = $cate_id->maDanhMuc;
                // Lấy bài viết theo thứ tự mã giảm dần, từ tên xuống, mặc định lấy 6 bài viết 1 lần click //
                $tintucMoi = News::where('trangThai', '1')->where('maDanhMuc', $id)->where('maBaiViet', '<', $data['id'])->orderby('maBaiViet', 'DESC')->take(6)->get();
            }
            
        }else{ // Mặc định mới vào trang // 
            if($data['slug'] == 'tin-moi-nhat'){
                // Lấy bài viết mới nhất dựa theo mã, bỏ qua 4 bài viết đầu tiên //
                $tintucMoi = News::where('trangThai', '1')->orderBy('maBaiViet', 'DESC')->skip(4)->take(3)->get();
            }else{
                // Lấy id của danh mục bài viết //
                $cate_id = CateNews::where('slug', $data['slug'])->first();
                $id = $cate_id->maDanhMuc;
                // Lấy bài viết mới nhất dựa theo mã, bỏ qua 4 bài viết đầu tiên //
                $tintucMoi = News::where('trangThai', '1')->where('maDanhMuc', $id)->orderBy('maBaiViet', 'DESC')->skip(4)->take(3)->get();
            }
        }

        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString(); // Lấy thời gian hiện tại //
        
        $output = '';
        // Nếu biến tintucMoi khác rỗng //
        if(!$tintucMoi->isEmpty()){
            foreach($tintucMoi as $key => $tin){
                $last_id = $tin->maBaiViet;
                $dt = Carbon::parse($tin->created_at);
                // Gán giao diện hiển thị bài viết vào output // 
                $output.="
                
                <li data-id='".$tin->maBaiViet."'  style='padding-bottom: 10px;'>
                        <div class='single-products' style='margin:10px 0;'>
                            <img style='float:left;width:30%;padding: 5px;height: 100%; margin-right: 5px;'
                                src='".url('public/upload/news/'.$tin->hinhAnh)." ' alt='' />

                            <h4 style='padding: 5px;'><a href='".url('/chi-tiet-bai-viet.html/'.$tin->slug)."'
                                    style='color:#000000;'>".$tin->tieuDe."</a> </h4>
                            <p style='font-size:13px'>".$dt->diffForHumans($now)."</p>
                        </div>
                    </li>";
            }
            // Gán nút load more //
            $output .="
                    <div id='load_more' style='text-align:center'>
                        <button name='load_more_button' style='width:30%' class='btn btn-primary form-control' data-id='".$last_id."'
                        id ='load_more_button'>Xem thêm <i class='fa fa-angle-double-down' aria-hidden='true'></i></button>
                    </div>
                
                ";
        }else{ // biến tintucMoi rỗng - hết bài viết trong db //
            $output .="
                    <div id='load_more'>
                        <button type='button' name='load_more_button' class='btn btn-default form-control'
                        id ='load_more_button'>Đang cập nhật...</button>
                    </div>
                
                ";
        }
        
        
        echo $output;
        
    }
}
