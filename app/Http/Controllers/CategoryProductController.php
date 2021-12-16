<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
session_start();

class CategoryProductController extends Controller
{
    // frontend //
    public function Categoryproduct($cate_slug){

        // Sidebar //
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
        // End sidebar //
        

        $cate_id = DB::table('danhmucsanpham')->select('maDanhMuc', 'danhMucCha')->where("slug", $cate_slug)->get();
        foreach($cate_id as $key =>$id){
            $cate_by_id = $id->maDanhMuc;
            $id_danh_muc_cha = $id->danhMucCha;
        }

        $sl_DanhMucCon = DB::table('danhmucsanpham')
        ->select(DB::raw('count(*) as SL'))
        ->where('danhmucsanpham.danhMucCha', $cate_by_id)
        ->first();

        
        
        // Thuộc Danh mục cha và có danh mục con 
        if($id_danh_muc_cha == 0 && $sl_DanhMucCon->SL != 0){
            $product_of_cate = DB::table("dbsanpham")
                ->whereRaw('dbsanpham.madanhmuc IN (select danhmucsanpham.maDanhMuc from danhmucsanpham WHERE danhmucsanpham.danhMucCha = '.$cate_by_id.')')
                ->paginate(6);
        }else{
            $product_of_cate = DB::table('dbsanpham')->where('maDanhMuc', $cate_by_id)->paginate(6);
        }
        
        
        
        $name_product = DB::table('danhmucsanpham')->where('slug', $cate_slug)->select('tenDanhMuc')->get();

        return view('frontend.pages.productsPages.categoryProduct')->with('all_brands', $all_brands)
        ->with('all_category_products', $all_category_products)
        ->with('product_of_cate', $product_of_cate)
        ->with('name_product', $name_product)
        ->with('count_danhMucCon', $count_danhMucCon);
    }



    // backend //

    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }

    public function lietKeDanhMucSanPham(){
        $this->checkLogin();
        $all_category_products = DB::table('danhmucsanpham')->orderby('maDanhMuc')->get();
        return view('backend.pages.danhMucSanPham.lietKeDanhMucSanPham')->with('all_category_products' ,$all_category_products);
    }
    public function themDanhMucSanPham(){
        $this->checkLogin();
        $cate_parent = DB::table('danhmucsanpham')->where('danhMucCha', 0)->get();
        return view('backend.pages.danhMucSanPham.themDanhMucSanPham')->with('cate_parent', $cate_parent);
    }
    public function suaDanhMucSanPham($cate_product_id){
        $this->checkLogin();
        $edit_cate_product = DB::table('danhmucsanpham')->where('maDanhMuc', $cate_product_id)->get();
        $cate_parent = DB::table('danhmucsanpham')->where('danhMucCha', 0)->get();
        return view('backend.pages.danhMucSanPham.suaDanhMucSanPham')->with('edit_cate_procuct', $edit_cate_product)
        ->with('cate_parent', $cate_parent);
    }
    public function createCategoryProduct(Request $request){
        $this->checkLogin();
        $data = array();
        $data['tenDanhMuc'] = $request->tenDanhMuc;
        $data['slug'] = $request->slug_danhmucsanpham;
        $data['moTaDanhMuc'] = $request->moTaDanhMuc;
        $data['danhMucCha'] = $request->thuocDanhMuc;
        $data['trangThai'] = $request->trangThai;
        
        //var_dump($data); exit;
        DB::table('danhmucsanpham')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('/liet-ke-danh-muc-san-pham.html')->with('error_code', 5);
    }
    public function updateCategoryProduct(Request $request, $cate_product_id){
        $this->checkLogin();
        $data = array();
        $data['tenDanhMuc'] = $request->tenDanhMuc;
        $data['slug'] = $request->slug_danhmucsanpham;
        $data['moTaDanhMuc'] = $request->moTaDanhMuc;
        $data['trangThai'] = $request->trangThai;
        $data['danhMucCha'] = $request->thuocDanhMuc;

        //var_dump($data); exit;
        DB::table('danhmucsanpham')->where('maDanhMuc', $cate_product_id)->update($data);
        Session::put('message', 'Cập nhật thành công');
        return Redirect::to('/liet-ke-danh-muc-san-pham.html')->with('error_code', 5);
    }
    public function xoaDanhMucSanPham($cate_product_id){
        $this->checkLogin();

        $sl_sanPham= DB::table("danhmucsanpham")->leftJoin("dbsanpham", function($join){
	    $join->on("danhmucsanpham.madanhmuc", "=", "dbsanpham.madanhmuc");})
        ->select("danhmucsanpham.tendanhmuc", DB::raw("count(dbsanpham.masanpham) as sl"))
        ->where("danhmucsanpham.maDanhMuc", $cate_product_id)
        ->groupBy("danhmucsanpham.maDanhMuc")
        ->get();
        
       // var_dump($sl_sanPham[0]->sl); exit;
       if(($sl_sanPham[0]->sl) > 0){
            Session::put('error_mess', 'Danh mục đã có sản phẩm, không thể xóa');
            return Redirect::to('/liet-ke-danh-muc-san-pham.html');
       }else{
            DB::table('danhmucsanpham')->where('maDanhMuc', $cate_product_id)->delete();
            Session::put('message', 'Xóa thành công');
       }
        
        return Redirect::to('/liet-ke-danh-muc-san-pham.html')->with('error_code', 5);;
    }

    public function product_tabs(Request $request){
        $data = $request->all();

        $output = '';
        $product = DB::table('dbsanpham')->where('maDanhMuc', $data['cate_id'])->limit(4)->get();
        $product_count = $product->count();
        if($product_count > 0){
            $output.= "
            <div class='tab-content'>
                <div class='tab-pane fade active in' id='tshirt'>
                ";
                foreach($product as $key => $pro){
                $output.= " <div class='col-sm-3'>
                        <div class='product-image-wrapper'>
                            <div class='single-products'>
                                <div class='productinfo text-center'>
                                <a href='".url('/product-details.html/'.$pro->slug)."'><img src='public/upload/products/$pro->hinhAnh' alt='$pro->tenSanPham' /></a>
                                    <h2>".number_format($pro->giaSanPham)." VNĐ</h2>
                                    <a href='".url('/product-details.html/'.$pro->slug)."'><p>$pro->tenSanPham</p></a>
                                    <a href='".url('/product-details.html/'.$pro->slug)."' class='btn btn-default add-to-cart'>Xem ngay <i class='fa fa-arrow-right' aria-hidden='true'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>";

                }
            $output.= " </div>
            </div>
            ";
        }else{
            $output.= "
            <div class='tab-content'>
                <div class='tab-pane fade active in' id='tshirt'>
                    <div class='col-sm-12'>
                        <h4 style='text-align: center; margin-bottom: 50px;'>Chưa có sản phẩm</h4>
                    </div>
                </div>
            </div>
            
            ";
        }
        echo $output;
    }
}