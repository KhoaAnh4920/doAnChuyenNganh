<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use Alert;
session_start();

class galleryController extends Controller
{
    public function checkLogin(){
        $user_id = Session::get('admin_id');
        if($user_id == null)
            return Redirect::to('/admin-login.html')->send();
    }
    public function lietKeDanhMucHinh($product_id){
        $this->checkLogin();
        $pro_id = $product_id;
        return view('backend.pages.danhMucHinhSanPham.lietKeDanhMucHinh')->with(compact('pro_id'));
    }
    public function themDanhMucHinh(){
        $this->checkLogin();
        return view('backend.pages.danhMucHinhSanPham.themDanhMucHinh');
    }
    public function suaDanhMucHinh(){
        $this->checkLogin();
        return view('backend.pages.danhMucHinhSanPham.suaDanhMucHinh');
    }
    public function insertGallery(Request $request, $pro_id){
        $this->checkLogin();
        $data = array();
        $data['maSanPham'] = $pro_id;
        $data['hienThi'] = 1;
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName(); // Lấy tên file
            $image->move('public/upload/gallery', $get_name_image);
            $data['hinh'] = $get_name_image;

            DB::table('danhmuchinh')->insert($data);
            Session::put('message', 'Thêm thành công');
            
            //return Redirect::to('/liet-ke-user.html')
            }
        }
        return redirect()->back()->with('error_code', 5);
    }
    public function hienThiDanhMuc(Request $request){
        $this->checkLogin();

        $product_id = $request->pro_id;
        $gallery = DB::table('danhmuchinh')->where('maSanPham', $product_id)->get();
        $gallery_count = $gallery->count();

        $output = '
        <form>
        '.csrf_field().'

        <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>ID hình</th>
                            <th>ID sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Hiển thị</th>
                            <th>Action</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        if($gallery_count > 0){
            $i = 0;
            foreach($gallery as $key => $hinh){
                $i++;
                $output.='
                        <tr>                          
                            <td>'.$i.'</td>
                            <td>'.$hinh->maSanPham.'</td>
                            <td>
                            <img src="'.url('public/upload/gallery/'.$hinh->hinh).'" class="img-thumbnail" width="120" height="120">
                            <input type="file" class="file_image" style="width:40%" data-gal_id="'.$hinh->maHinhSanPham.'" id="file-'.$hinh->maHinhSanPham.'" name="file" accept="image/*" />
                            </td>
                            <td>'.$hinh->hienThi.'</td>
                            <td>
                            <a href="#my-modal_'.$hinh->maHinhSanPham.'" data-toggle="modal" class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i> Delete</a>
                            
                            <div id="my-modal_'.$hinh->maHinhSanPham.'" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-0">
                                        <div class="modal-body p-0">
                                            <div class="card border-0 p-sm-3 p-2 justify-content-center">
                                                <div class="card-header pb-0 bg-white border-0 ">
                                                    <div class="row">
                                                        <div class="col ml-auto"><button type="button" class="close btnClose" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                                        <h4 style="padding:10px 10px 10px 12px">Xác nhận xóa</h4>
                                                        <hr>     
                                                    </div>
                                                    <p class="font-weight-bold mb-2" style="margin-bottom:20px">Bạn có muốn xóa không ?</p>
                                                    
                                                </div>
                                                <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                                <div class="row">
                                                <hr>
                                                </div>
                                                    <div class="row justify-content-end no-gutters">
                                                        <div class="col-auto" style="float:right; margin-right:20px">
                                                            <button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-danger px-4"><a class="btnDeleteUser" href="'.url('/delete-gallery/'.$hinh->maHinhSanPham).'">Deleteee</a></button>
                                
                                                        </div>
                                                        <!-- <div class="col-auto"><button type="button" class="btn btn-danger px-4" data-dismiss="modal">Delete</button></div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            </td>
                        </tr>
                
                ';
            }
        }else{
            $output.='
                <tr>                          
                    <td colspan="5">Sản phẩm chưa thư viện ảnh</td>
                 </tr>
            
            ';
        }
        $output.='
    				 </tbody>
    				 </table>
    				 </form>

    			';
        echo $output;
    }
    public function deleteGallery($gal_id){
        
        $image = DB::table('danhmuchinh')->select('hinh')->where('maHinhSanPham', $gal_id)->get();
        foreach($image as $key =>$hinh){
            $h = $hinh->hinh;
        }
        unlink('public/upload/gallery/'.$h);
        DB::table('danhmuchinh')->where('maHinhSanPham', $gal_id)->delete();
        Session::put('message', 'Xóa thành công');
        return redirect()->back()->with('error_code', 5);
    }
    public function updateGallery(Request $request){
        $this->checkLogin();
        $data = array();
        $gal_id = $request->gal_id;
        $get_image = $request->file('file');
        if($get_image){
            // Add hình mới vào //
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên file
            $get_image->move('public/upload/gallery', $get_name_image);
            $data['hinh'] = $get_name_image;

            // Xóa hình cũ // 
            $image_old = DB::table('danhmuchinh')->select('hinh')->where('maHinhSanPham', $gal_id)->get();
            foreach($image_old as $key =>$hinh){
                $h = $hinh->hinh;
            }
            unlink('public/upload/gallery/'.$h);

            // update hình vào db //
            DB::table('danhmuchinh')->where('maHinhSanPham', $gal_id)->update($data);
            
            
        }
    }
}
