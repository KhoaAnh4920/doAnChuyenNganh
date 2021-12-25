<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use App\Brand;
use View;
use Alert;
session_start();

class BrandController extends Controller
{
    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
    public function Brandproduct($brand_slug){
        // Header //
        $cate_of_Apple = DB::table("danhmucsanpham")
            ->whereRaw('danhmucsanpham.maDanhMuc IN (select dbsanpham.maDanhMuc FROM dbsanpham JOIN thuonghieu on thuonghieu.maThuongHieu = dbsanpham.maThuongHieu WHERE thuonghieu.maThuongHieu = 1)')
            ->get();
        $cate_of_Gear = DB::table("danhmucsanpham")
            ->select('tenDanhMuc', 'slug')
            ->where('danhMucCha', 14)
            ->get();

        // end header

        $all_brands = Brand::leftJoin("dbsanpham", function($join){
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

        $brand_id = Brand::where("slug", $brand_slug)->pluck('maThuongHieu');
        //var_dump($brand_id); exit;
        foreach($brand_id as $key =>$id){
            $brand_by_id = $id;
        }
        $product_of_brand = DB::table('dbsanpham')->where("maThuongHieu", $brand_by_id)->paginate(6);
        $name_brand = DB::table('thuonghieu')->where('maThuongHieu', $brand_by_id)->select('tenThuongHieu')->get();

        View::share('cate_of_Apple', $cate_of_Apple);
        View::share('cate_of_Gear', $cate_of_Gear);
        
        return view('frontend.pages.productsPages.brandProduct')->with('all_brands', $all_brands)
        ->with('all_category_products', $all_category_products)
        ->with('product_of_brand', $product_of_brand)
        ->with('name_brand', $name_brand)
        ->with('count_danhMucCon', $count_danhMucCon);
    }
    public function lietKeThuongHieu(){
        $this->checkLogin();
        $all_brands = Brand::orderby('maThuongHieu')->get();
        return view('backend.pages.danhMucThuongHieu.lietKeThuongHieu')->with('all_brands', $all_brands);
    }
    public function themThuongHieu(){
        $this->checkLogin();
        return view('backend.pages.danhMucThuongHieu.themThuongHieu');
    }
    public function suaThuongHieu($brand_id){
        $this->checkLogin();
        $edit_brand = Brand::where('maThuongHieu', $brand_id)->get();
 
        return view('backend.pages.danhMucThuongHieu.suaThuongHieu')->with('edit_brand', $edit_brand);
    }
    public function xoaThuongHieu($brand_id){
        $this->checkLogin();

        $sl_sanPham= Brand::leftJoin("dbsanpham", function($join){
        $join->on("thuonghieu.maThuongHieu", "=", "dbsanpham.maThuongHieu");})
        ->select("thuongHieu.tenThuongHieu", DB::raw("count(dbsanpham.masanpham) as sl"))
        ->where("thuonghieu.maThuongHieu", $brand_id)
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();

        if(($sl_sanPham[0]->sl) > 0){
            Session::put('message', 'Thương hiệu đã có sản phẩm, không thể xóa');
        }else{
            $n = Brand::where('maThuongHieu', $brand_id)->delete();
            if($n > 0)
                Alert::success('Xóa thành công');
            else
                Alert::error('Xóa thất bại');
            //Session::put('message', 'Xóa thành công');
        }

        return redirect('/liet-ke-thuong-hieu.html');
    }
    public function createBrand(Request $request){
        $this->checkLogin();
        // $data = array();
        // $data['tenThuongHieu'] = $request->tenThuongHieu;
        // $data['slug'] = $request->slug_thuonghieu;
        // $data['moTaThuongHieu'] = $request->moTaThuongHieu;
        // $data['trangThai'] = $request->trangThai;

        $brand = new Brand();
        $brand->tenThuongHieu = $request->tenThuongHieu;
        $brand->slug = $request->slug_thuonghieu;
        $brand->moTaThuongHieu = $request->moTaThuongHieu;
        $brand->trangThai = $request->trangThai;

        //DB::table('thuonghieu')->insert($data);
        $n = $brand->save();
        if($n)
            Alert::success('Thêm thành công');
        else
            Alert::error('Thêm thất bại');
        //Session::put('message', 'Thêm thành công');
        return redirect('/liet-ke-thuong-hieu.html')->with('error_code', 5);
    }
    public function updateBrand(Request $request,$brand_id){
        $this->checkLogin();
        $data = array();

        $brand = Brand::find($brand_id);
        $brand->tenThuongHieu = $request->tenThuongHieu;
        $brand->slug = $request->slug_thuonghieu;
        $brand->moTaThuongHieu = $request->moTaThuongHieu;
        $brand->trangThai = $request->trangThai;
        $n = $brand->save();
        if($n)
            Alert::success('Cập nhật thành công');
        else
            Alert::error('Cập nhật thất bại');
        
        //DB::table('thuonghieu')->where('maThuongHieu', $brand_id)->update($data);
        //Session::put('message', 'Cập nhật thành công');
        return redirect('/liet-ke-thuong-hieu.html');
    }

}
