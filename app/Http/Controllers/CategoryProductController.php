<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use App\CategoryProduct;
use App\Brand;
use View;
use Alert;
use Auth;
use App\User;
use App\Admin;
session_start();

class CategoryProductController extends Controller
{
    // frontend //

    // Hiển thị sản phẩm thuộc danh mục // 
    public function Categoryproduct($cate_slug){
        
        // Lấy mã của danh mục dựa vào slug //
        $cate_id = CategoryProduct::select('maDanhMuc', 'danhMucCha')->where("slug", $cate_slug)->get();
        foreach($cate_id as $key =>$id){
            $cate_by_id = $id->maDanhMuc;
            $id_danh_muc_cha = $id->danhMucCha;
        }

        $sl_DanhMucCon = CategoryProduct::select(DB::raw('count(*) as SL'))
        ->where('danhmucsanpham.danhMucCha', $cate_by_id)
        ->first();

        
        // Load sản phẩm thuộc danh mục sản phẩm //

        // Thuộc Danh mục cha và có danh mục con 
        if($id_danh_muc_cha == 0 && $sl_DanhMucCon->SL != 0){
            $product_of_cate = DB::table("dbsanpham")
                ->whereRaw('dbsanpham.madanhmuc IN (select danhmucsanpham.maDanhMuc from danhmucsanpham WHERE danhmucsanpham.danhMucCha = '.$cate_by_id.')')
                ->where("dbsanpham.trangThai", 1)
                ->paginate(6);
        }else{
            $product_of_cate = DB::table('dbsanpham')->where("dbsanpham.trangThai", 1)->where('maDanhMuc', $cate_by_id)->paginate(6);
        }
        
        
        $name_product = CategoryProduct::where('slug', $cate_slug)->select('tenDanhMuc')->get();

        return view('frontend.pages.productsPages.categoryProduct')
        ->with('product_of_cate', $product_of_cate)
        ->with('name_product', $name_product);
    }



    // backend //

    public function checkLogin(){
        // Lấy id user từ trong session //
        $isLogin = Auth::guard('admin')->check();
        // Nếu id user = null - chưa đăng nhập, return về trang đăng nhập //
        if(!$isLogin)
            return Redirect::to('/admin-login.html')->send();
    }

    // Trang liệt kê danh mục sản phẩm // 
    public function lietKeDanhMucSanPham(){
        $this->checkLogin();
        $all_category_products = CategoryProduct::orderby('maDanhMuc')->get();
        return view('backend.pages.danhMucSanPham.lietKeDanhMucSanPham')->with('all_category_products' ,$all_category_products);
    }
    // Trang thêm danh mục sản phẩm // 
    public function themDanhMucSanPham(){
        $this->checkLogin();
        $cate_parent = CategoryProduct::where('danhMucCha', 0)->get();
        return view('backend.pages.danhMucSanPham.themDanhMucSanPham')->with('cate_parent', $cate_parent);
    }
    // Trang sửa danh mục sản phẩm //
    public function suaDanhMucSanPham($cate_product_id){
        $this->checkLogin();
        // Lấy danh mục cần sửa //
        $edit_cate_product = CategoryProduct::where('maDanhMuc', $cate_product_id)->get();
        // Lấy danh mục cha //
        $cate_parent = CategoryProduct::where('danhMucCha', 0)->get();
        return view('backend.pages.danhMucSanPham.suaDanhMucSanPham')->with('edit_cate_procuct', $edit_cate_product)
        ->with('cate_parent', $cate_parent);
    }
    // Thêm danh mục sản phẩm vào db //
    public function createCategoryProduct(Request $request){
        $this->checkLogin();
        $data = array();
        // Tạo đối tượng danh mục từ model //
        $category = new CategoryProduct();
        $category->tenDanhMuc = $request->tenDanhMuc;
        $category->slug = $request->slug_danhmucsanpham;
        $category->moTaDanhMuc = $request->moTaDanhMuc;
        $category->danhMucCha = $request->thuocDanhMuc;
        $category->trangThai = $request->trangThai;

        // Lưu danh mục vào db //
        $n = $category->save();
        if($n)
            Alert::success('Thêm thành công');
        else
            Alert::error('Thêm thất bại');

        // $data['tenDanhMuc'] = $request->tenDanhMuc;
        // $data['slug'] = $request->slug_danhmucsanpham;
        // $data['moTaDanhMuc'] = $request->moTaDanhMuc;
        // $data['danhMucCha'] = $request->thuocDanhMuc;
        // $data['trangThai'] = $request->trangThai;
        
        // DB::table('danhmucsanpham')->insert($data);
        //Session::put('message', 'Thêm thành công');
        return Redirect::to('/liet-ke-danh-muc-san-pham.html');
    }
    // Cập nhật thông tin danh mục sản phẩm // 
    public function updateCategoryProduct(Request $request, $cate_product_id){
        $this->checkLogin();

        $category = CategoryProduct::find($cate_product_id);

        $category->tenDanhMuc = $request->tenDanhMuc;
        $category->slug = $request->slug_danhmucsanpham;
        $category->moTaDanhMuc = $request->moTaDanhMuc;
        $category->danhMucCha = $request->thuocDanhMuc;
        $category->trangThai = $request->trangThai;

        $n = $category->save();
        if($n)
            Alert::success('Thêm thành công');
        else
            Alert::error('Thêm thất bại');
        // $data = array();
        // $data['tenDanhMuc'] = $request->tenDanhMuc;
        // $data['slug'] = $request->slug_danhmucsanpham;
        // $data['moTaDanhMuc'] = $request->moTaDanhMuc;
        // $data['trangThai'] = $request->trangThai;
        // $data['danhMucCha'] = $request->thuocDanhMuc;

        //var_dump($data); exit;
        //DB::table('danhmucsanpham')->where('maDanhMuc', $cate_product_id)->update($data);
        //Session::put('message', 'Cập nhật thành công');
        return Redirect::to('/liet-ke-danh-muc-san-pham.html');
    }
    // Xóa danh mục sản phẩm trong db //
    public function xoaDanhMucSanPham($cate_product_id){
        $this->checkLogin();

        // Kiểm tra danh mục đã có sản phẩm chưa //
        $sl_sanPham= CategoryProduct::leftJoin("dbsanpham", function($join){
	    $join->on("danhmucsanpham.madanhmuc", "=", "dbsanpham.madanhmuc");})
        ->select("danhmucsanpham.tendanhmuc", DB::raw("count(dbsanpham.masanpham) as sl"))
        ->where("danhmucsanpham.maDanhMuc", $cate_product_id)
        ->groupBy("danhmucsanpham.maDanhMuc")
        ->get();
        // Check danh mục cha //
        $maDanhMucCha = CategoryProduct::select(DB::raw("count(*) as sl"))
        ->where("danhmucsanpham.danhmuccha", "=", $cate_product_id)
        ->get();

        // Kiểm tra danh mục định xóa có phải danh mục cha hoặc đã có sản phẩm //
        if($maDanhMucCha[0]->sl > 0 || $sl_sanPham[0]->sl > 0){
            if(($sl_sanPham[0]->sl) > 0)
                Alert::error('Danh mục đã có sản phẩm');
            else
                Alert::error('Không thể xóa danh mục cha');
        }else{
            $n = CategoryProduct::where('maDanhMuc', $cate_product_id)->delete();
            if($n)
                Alert::success('Xóa thành công');
            else
                Alert::error('Xóa thất bại');
        }
        
        return Redirect::to('/liet-ke-danh-muc-san-pham.html');
    }
}
