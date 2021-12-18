@extends('backend.layouts.master')
@section('title','Sửa sản phẩm')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Basics</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sửa sản phẩm</h6>
                </div>
                <div class="card-body">
                    @foreach($edit_pro as $key => $pro)
                    <form role="form" action="{{URL::to('/update-product.html/'.$pro->maSanPham)}}" method="post"
                        enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputNameProduct">Mã sản phẩm</label>
                            <input type="text" class="form-control" readonly value="{{$pro->maSanPham}}" name="maSanPham"
                                placeholder="Mã sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNameProduct">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="tenSanPham" value="{{$pro->tenSanPham}}"
                                placeholder="Tên sản phẩm" id="title_slug" onkeyup="ChangeToSlug();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSlug">SLug</label>
                            <input type="text" class="form-control" id="convert_slug" name="slug_sanpham"
                                value="{{$pro->slug}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPrice">Giá</label>
                            <input type="number" class="form-control" value="{{$pro->giaSanPham}}" name="giaSanPham"
                                placeholder="Giá">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputImage">Hình ảnh</label>
                            <div class="custom-file">
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="customFile"
                                    name="hinhAnh">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img id="blah" style="width:100px; margin-top:5px; margin-bottom:80px"
                                    src="../public/upload/products/{{$pro->hinhAnh}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputImage">Danh mục hình ảnh</label>
                            <div class="custom-file">
                                <!-- <input id="file-input" type="file" multiple>
                                <div id="preview">
                                <img id="blah" style="width:100px; margin-top:5px; margin-bottom:80px"
                                    src="../public/upload/products/{{$pro->hinhAnh}}">
                                    </div> -->
                                <input type="file" class="custom-file-input file" id="files" name="file[]"
                                    accept="image/*" multiple>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div class="cate_image" id="preview" style="overflow-y: hidden;">

                                    @foreach($cate_image as $key => $cate_img)
                                    <span class="pip">
                                        <img src="../public/upload/gallery/{{$cate_img->hinh}}">
                                        <span class="removeDefault"
                                            data-gal_id="{{$cate_img->maHinhSanPham}}">Xóa</span>
                                    </span>
                                    @endforeach
                                </div>

                                <!-- <input type="file" id="files" name="files[]" multiple /></br> -->
                                <!-- <input type="submit" name="submit" value="Submit"> -->

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDanhMuc">Thuộc danh mục</label>
                            <select class="form-control" name="danhMucSanPham">
                                @foreach($all_category_products as $key => $cate)
                                @if($cate->danhMucCha == 0)
                                <option value="{{$cate->maDanhMuc}}"
                                    {{($cate->maDanhMuc == $pro->maDanhMuc) ? 'selected' :''}} style="color:red">
                                    {{$cate->tenDanhMuc}}</option>
                                @foreach($all_category_products as $key => $cate_sub)
                                @if($cate_sub->danhMucCha == $cate->maDanhMuc)
                                <option value="{{$cate_sub->maDanhMuc}}"
                                    {{($cate_sub->maDanhMuc == $pro->maDanhMuc) ? 'selected' :''}}>
                                    ---{{$cate_sub->tenDanhMuc}}</option>
                                @endif
                                @endforeach
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputBrands">Thương hiệu</label>
                            <select class="form-control" name="thuongHieu">
                                @foreach($all_brands as $key => $brands)
                                @if($brands->maThuongHieu == $pro->maThuongHieu)
                                <option selected value="{{$brands->maThuongHieu}}">{{$brands->tenThuongHieu}}</option>
                                @else
                                <option value="{{$brands->maThuongHieu}}">{{$brands->tenThuongHieu}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputMoTa">Mô tả</label>
                            <textarea class="form-control" id="ckeditor_editProduct" name="moTaSanPham"
                                rows="4">{{$pro->moTaSanPham}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStatus">Trạng thái</label>
                            <select class="form-control" name="trangThai">
                                <option value="0" {{($pro->trangThai == 0) ? 'selected': ''}}>Ẩn</option>
                                <option value="1" {{($pro->trangThai == 1) ? 'selected': ''}}>Hiện</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="col-lg-2"></div>


    </div>


</div>
<!---Container Fluid-->

@endsection