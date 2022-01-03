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
session_start();

class NewsController extends Controller
{
    // frontend // 
    public function danhMucBaiViet($tenDanhMuc){
        $all_brands = DB::table("thuonghieu")
        ->leftJoin("dbsanpham", function($join){
            $join->on("thuonghieu.mathuonghieu", "=", "dbsanpham.mathuonghieu");
        })
        ->select("thuonghieu.*", DB::raw('count(dbsanpham.masanpham) as sl'))
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();

        $all_category_products = DB::table('danhmucsanpham')->orderby('maDanhMuc')->get();

        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();

        // end header
        

        // Đếm số lượng danh mục con của từng danh mục cha //
        $count_danhMucCon = DB::table('danhmucsanpham')
        ->select( "danhmucsanpham.maDanhMuc as maDanhMucCha","danhmucsanpham.tenDanhMuc","danhmucsanpham.slug",DB::raw('(select count(*) from danhmucsanpham where danhmucsanpham.danhMucCha = maDanhMucCha) as SL'))
        ->where('danhmucsanpham.danhMucCha', 0)
        ->get();

        // Danh mục bài viết //
        $cate_news = CateNews::orderBy('maDanhMuc')->take(3)->get();
        if($tenDanhMuc == 'tin-moi-nhat'){
            $tintuc = News::orderBy('maBaiViet', 'DESC')->get();
        }else{
            $cate_id = CateNews::where('slug', $tenDanhMuc)->first();
            $id = $cate_id->maDanhMuc;
            $tintuc = News::where('maDanhMuc', $id)->orderBy('maBaiViet', 'DESC')->get();
        }

        $tinKhuyenMai = News::where('maDanhMuc', 4)->orderBy('maBaiViet', 'DESC')->get();

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);
        
        return view('frontend.pages.news.danhMucBaiViet')->with('all_brands', $all_brands)
        ->with('all_category_products', $all_category_products)
        ->with('count_danhMucCon', $count_danhMucCon)
        ->with('cate_news', $cate_news)
        ->with('tintuc', $tintuc)
        ->with('slug', $tenDanhMuc)
        ->with('khuyenMai', $tinKhuyenMai);
    }
    public function hienThiBaiViet($news_slug){
        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();

        // end header
        // Đếm số lượng danh mục con của từng danh mục cha //
        $count_danhMucCon = DB::table('danhmucsanpham')
        ->select( "danhmucsanpham.maDanhMuc as maDanhMucCha","danhmucsanpham.tenDanhMuc","danhmucsanpham.slug",DB::raw('(select count(*) from danhmucsanpham where danhmucsanpham.danhMucCha = maDanhMucCha) as SL'))
        ->where('danhmucsanpham.danhMucCha', 0)
        ->get();

        $all_category_products = DB::table('danhmucsanpham')->orderby('maDanhMuc')->get();
        $all_brands = DB::table("thuonghieu")
        ->leftJoin("dbsanpham", function($join){
            $join->on("thuonghieu.mathuonghieu", "=", "dbsanpham.mathuonghieu");
        })
        ->select("thuonghieu.*", DB::raw('count(dbsanpham.masanpham) as sl'))
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();


        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);

        $news = News::join("users", function($join){
            $join->on("users.users_id", "=", "baiviet.users_id");
        })
        ->select("baiviet.*", "users.users_name")
        ->where('slug', $news_slug)->first(); 

        $maDanhMuc = $news->maDanhMuc;
        $maBaiViet = $news->maBaiViet;
        $tinLienQuan = News::where('maDanhMuc', $maDanhMuc)->where('maBaiViet', '<>', $maBaiViet)->orderBy('maBaiViet', 'DESC')->take(3)->get();

        return view('frontend.pages.news.baiViet')
        ->with('all_brands', $all_brands)
        ->with('all_category_products', $all_category_products)
        ->with('count_danhMucCon', $count_danhMucCon)
        ->with('news', $news)
        ->with('tinLienQuan', $tinLienQuan);
    }

    // backend//
    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
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
    public function themBaiViet(){
        $this->checkLogin();
        $all_category_news = CateNews::orderBy('maDanhMuc')->get();
        return view('backend.pages.baiViet.themBaiViet')->with('all_category_news', $all_category_news);
    }
    public function suaBaiViet($news_id){
        $this->checkLogin();
        $edit_news = News::find($news_id);
        $all_category_news = CateNews::orderBy('maDanhMuc')->get();
        return view('backend.pages.baiViet.suaBaiViet')->with('edit_news', $edit_news)->with('all_category_news', $all_category_news);
    }

    public function checkimg($h){
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
        // Define maxsize for files i.e 2MB
        $maxsize = 2 * 1024 * 1024;
        $file_name = $h->getClientOriginalName();
        $file_size = $h->getSize();
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // Check file type is allowed or not
        if(in_array(strtolower($file_ext), $allowed_types)) {
            // Verify file size - 2MB max
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

    public function createNews(Request $request){
        $this->checkLogin();
        $user_id = Session::get('admin_id');
        $news = new News();
        $news->tieuDe = $request->tieuDeBaiViet;
        $news->slug = $request->slug_BaiViet;
        $news->moTa = $request->moTaBaiViet;
        $news->noiDung = $request->noiDungBaiViet;
        $news->maDanhMuc = $request->danhMucBaiViet;
        $news->trangThai = $request->trangThai;
        $news->users_id = $user_id;
        $dt = Carbon::now('Asia/Ho_Chi_Minh');

        $news->created_at = $dt->toDateTimeString();

        $get_image = $request->file('hinhAnh');
        if($get_image && $this->checkimg($get_image)){
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/news', $get_name_image);
            $news->hinhAnh = $get_name_image;

        }
        $n = $news->save();
        if($n)
            Alert::success('Thêm thành công');
        else
            Alert::error('Thêm thất bại');
        return Redirect::to('/liet-ke-bai-viet.html');
    }
    public function updateNews(Request $request, $new_id){
        $this->checkLogin();
        $user_id = Session::get('admin_id');
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
    public function xoaBaiViet($news_id){
       // $news = News::find($new_id);
       // $hinhAnh = $news['hinhAnh'];
       // unlink('public/upload/news/'.$hinhAnh);
        $n = News::where('maBaiViet', $news_id)->delete();
        if($n)
            Alert::success('Xóa thành công');
        else
            Alert::error('Xóa thất bại');
        return Redirect::to('/liet-ke-bai-viet.html');
    }

    public function load_more_news(Request $request){

        $data = $request->all();
        

        // Click vào load more //
        if($data['id'] > 0){
            if($data['slug'] == 'tin-moi-nhat'){
                $tintucMoi = News::where('trangThai', '1')->where('maBaiViet', '<', $data['id'])->orderby('maBaiViet', 'DESC')->take(6)->get();
            }else{
                $cate_id = CateNews::where('slug', $data['slug'])->first();
                $id = $cate_id->maDanhMuc;
                $tintucMoi = News::where('trangThai', '1')->where('maDanhMuc', $id)->where('maBaiViet', '<', $data['id'])->orderby('maBaiViet', 'DESC')->take(6)->get();
            }
            
        }else{ // Mặc định mới vào trang // 
            if($data['slug'] == 'tin-moi-nhat'){
                $tintucMoi = News::where('trangThai', '1')->orderBy('maBaiViet', 'DESC')->skip(4)->take(3)->get();
            }else{
                $cate_id = CateNews::where('slug', $data['slug'])->first();
                $id = $cate_id->maDanhMuc;
                $tintucMoi = News::where('trangThai', '1')->where('maDanhMuc', $id)->orderBy('maBaiViet', 'DESC')->skip(4)->take(3)->get();
            }
        }

        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        
        $output = '';
        if(!$tintucMoi->isEmpty()){
            foreach($tintucMoi as $key => $tin){
                $last_id = $tin->maBaiViet;
                $dt = Carbon::parse($tin->created_at);
                
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
            $output .="
                    <div id='load_more'>
                        <button name='load_more_button' class='btn btn-primary form-control' data-id='".$last_id."'
                        id ='load_more_button'>Xem thêm <i class='fa fa-angle-double-down' aria-hidden='true'></i></button>
                    </div>
                
                ";
        }else{
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
