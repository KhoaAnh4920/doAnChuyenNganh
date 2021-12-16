<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
session_start();

class BrandController extends Controller
{
    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
    public function Brandproduct($brand_slug){
        $all_brands = DB::table("thuonghieu")
        ->leftJoin("dbsanpham", function($join){
            $join->on("thuonghieu.mathuonghieu", "=", "dbsanpham.mathuonghieu");
        })
        ->select("thuonghieu.*", DB::raw('count(dbsanpham.masanpham) as sl'))
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();
        $all_category_products = DB::table('danhmucsanpham')->orderby('maDanhMuc')->get();
        $count_danhMucCon = DB::table('danhmucsanpham')
        ->select( "danhmucsanpham.maDanhMuc as maDanhMucCha","danhmucsanpham.tenDanhMuc","danhmucsanpham.slug",DB::raw('(select count(*) from danhmucsanpham where danhmucsanpham.danhMucCha = maDanhMucCha) as SL'))
        ->where('danhmucsanpham.danhMucCha', 0)
        ->get();

        $brand_id = DB::table('thuonghieu')->select('maThuongHieu')->where("slug", $brand_slug)->get();
        foreach($brand_id as $key =>$id){
            $brand_by_id = $id->maThuongHieu;
        }
        $product_of_brand = DB::table('dbsanpham')->where("maThuongHieu", $brand_by_id)->paginate(6);
        $name_brand = DB::table('thuonghieu')->where('maThuongHieu', $brand_by_id)->select('tenThuongHieu')->get();
        return view('frontend.pages.productsPages.brandProduct')->with('all_brands', $all_brands)
        ->with('all_category_products', $all_category_products)
        ->with('product_of_brand', $product_of_brand)
        ->with('name_brand', $name_brand)
        ->with('count_danhMucCon', $count_danhMucCon);
    }
    public function lietKeThuongHieu(){
        $this->checkLogin();
        $all_brands = DB::table('thuonghieu')->orderby('maThuongHieu')->get();
        return view('backend.pages.danhMucThuongHieu.lietKeThuongHieu')->with('all_brands', $all_brands);
    }
    public function themThuongHieu(){
        $this->checkLogin();
        return view('backend.pages.danhMucThuongHieu.themThuongHieu');
    }
    public function suaThuongHieu($brand_id){
        $this->checkLogin();
        $edit_brand = DB::table('thuonghieu')->where('maThuongHieu', $brand_id)->get();
 
        return view('backend.pages.danhMucThuongHieu.suaThuongHieu')->with('edit_brand', $edit_brand);
    }
    public function xoaThuongHieu($brand_id){
        $this->checkLogin();

        $sl_sanPham= DB::table("thuonghieu")->leftJoin("dbsanpham", function($join){
        $join->on("thuonghieu.maThuongHieu", "=", "dbsanpham.maThuongHieu");})
        ->select("thuongHieu.tenThuongHieu", DB::raw("count(dbsanpham.masanpham) as sl"))
        ->where("thuonghieu.maThuongHieu", $brand_id)
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();

        if(($sl_sanPham[0]->sl) > 0){
            Session::put('message', 'Thương hiệu đã có sản phẩm, không thể xóa');
        }else{
            DB::table('thuonghieu')->where('maThuongHieu', $brand_id)->delete();
            Session::put('message', 'Xóa thành công');
        }

        return redirect('/liet-ke-thuong-hieu.html')->with('error_code', 5);
    }
    public function createBrand(Request $request){
        $this->checkLogin();
        $data = array();
        $data['tenThuongHieu'] = $request->tenThuongHieu;
        $data['slug'] = $request->slug_thuonghieu;
        $data['moTaThuongHieu'] = $request->moTaThuongHieu;
        $data['trangThai'] = $request->trangThai;

        DB::table('thuonghieu')->insert($data);
        Session::put('message', 'Thêm thành công');
        return redirect('/liet-ke-thuong-hieu.html')->with('error_code', 5);
    }
    public function updateBrand(Request $request,$brand_id){
        $this->checkLogin();
        $data = array();
        $data['tenThuongHieu'] = $request->tenThuongHieu;
        $data['slug'] = $request->slug_thuonghieu;
        $data['moTaThuongHieu'] = $request->moTaThuongHieu;
        $data['trangThai'] = $request->trangThai;
        
        DB::table('thuonghieu')->where('maThuongHieu', $brand_id)->update($data);
        Session::put('message', 'Cập nhật thành công');
        return redirect('/liet-ke-thuong-hieu.html')->with('error_code', 5);
    }

}