<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use App\Brand;
use View;
use Alert;
use Auth;
use App\User;
use App\Admin;
session_start();

class BrandController extends Controller
{
    public function checkLogin(){
        // Lấy id user từ trong session //
        $isLogin = Auth::guard('admin')->check();
        // Nếu id user = null - chưa đăng nhập, return về trang đăng nhập //
        if(!$isLogin)
            return Redirect::to('/admin-login.html')->send();
    }
    // Hiển thị danh sách sản phẩm thuộc hãng //
    public function Brandproduct($brand_slug){
        // Lấy mã của thương hiệu dựa vào slug //
        $brand_id = Brand::where("slug", $brand_slug)->pluck('maThuongHieu');
        //var_dump($brand_id); exit;
        foreach($brand_id as $key =>$id){
            $brand_by_id = $id;
        }
        // Lấy sản phẩm thuộc thương hiệu - mặc định phân trang, một lần lấy 6 sản phẩm //
        $product_of_brand = DB::table('dbsanpham')->where("maThuongHieu", $brand_by_id)->where('dbsanpham.trangThai', 1)->paginate(6);
        // Lấy tên thương hiệu //
        $name_brand = DB::table('thuonghieu')->where('maThuongHieu', $brand_by_id)->select('tenThuongHieu')->get();
        
        return view('frontend.pages.productsPages.brandProduct')
        ->with('product_of_brand', $product_of_brand)
        ->with('name_brand', $name_brand);
    }
    // Liệt kê thương hiệu //
    public function lietKeThuongHieu(){
        $this->checkLogin();
        $all_brands = Brand::orderby('maThuongHieu')->get();
        return view('backend.pages.danhMucThuongHieu.lietKeThuongHieu')->with('all_brands', $all_brands);
    }
    // Trang thêm thương hiệu // 
    public function themThuongHieu(){
        $this->checkLogin();
        return view('backend.pages.danhMucThuongHieu.themThuongHieu');
    }
    // Trang sửa thương hiệu // 
    public function suaThuongHieu($brand_id){
        $this->checkLogin();
        $edit_brand = Brand::where('maThuongHieu', $brand_id)->get();
 
        return view('backend.pages.danhMucThuongHieu.suaThuongHieu')->with('edit_brand', $edit_brand);
    }
    // Xóa thương hiệu trong db //
    public function xoaThuongHieu($brand_id){
        $this->checkLogin();

        // Kiểm tra ràng buộc thương hiệu đã có sản phẩm hay chưa //
        $sl_sanPham= Brand::leftJoin("dbsanpham", function($join){
        $join->on("thuonghieu.maThuongHieu", "=", "dbsanpham.maThuongHieu");})
        ->select("thuongHieu.tenThuongHieu", DB::raw("count(dbsanpham.masanpham) as sl"))
        ->where("thuonghieu.maThuongHieu", $brand_id)
        ->groupBy("thuonghieu.maThuongHieu")
        ->get();

        // Nếu thương hiệu đã có sản phẩm - Không thể xóa //
        if(($sl_sanPham[0]->sl) > 0){
            Session::put('message', 'Thương hiệu đã có sản phẩm, không thể xóa');
        }else{ // Ngược lại, xóa thương hiệu trong db //
            $n = Brand::where('maThuongHieu', $brand_id)->delete();
            if($n > 0)
                Alert::success('Xóa thành công');
            else
                Alert::error('Xóa thất bại');
            //Session::put('message', 'Xóa thành công');
        }

        return redirect('/liet-ke-thuong-hieu.html');
    }
    // Thêm thương hiệu trong db //
    public function createBrand(Request $request){
        $this->checkLogin();
        // $data = array();
        // $data['tenThuongHieu'] = $request->tenThuongHieu;
        // $data['slug'] = $request->slug_thuonghieu;
        // $data['moTaThuongHieu'] = $request->moTaThuongHieu;
        // $data['trangThai'] = $request->trangThai;

        // Khởi tạo đối tượng từ model //
        $brand = new Brand();
        $brand->tenThuongHieu = $request->tenThuongHieu;
        $brand->slug = $request->slug_thuonghieu;
        $brand->moTaThuongHieu = $request->moTaThuongHieu;
        $brand->trangThai = $request->trangThai;

        // Lưu hãng vào db //
        $n = $brand->save();
        if($n)
            Alert::success('Thêm thành công');
        else
            Alert::error('Thêm thất bại');
        //Session::put('message', 'Thêm thành công');
        return redirect('/liet-ke-thuong-hieu.html')->with('error_code', 5);
    }
    // Cập nhật thông tin thương hiệu //
    public function updateBrand(Request $request,$brand_id){
        $this->checkLogin();
        $data = array();
        // Lấy thương hiệu cần cập nhật //
        $brand = Brand::find($brand_id);
        // Lấy thông tin value từ biến request //
        $brand->tenThuongHieu = $request->tenThuongHieu;
        $brand->slug = $request->slug_thuonghieu;
        $brand->moTaThuongHieu = $request->moTaThuongHieu;
        $brand->trangThai = $request->trangThai;
        // Lưu thông tin vào db //
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
