@extends('backend.layouts.master')
@section('title','Thêm danh mục sản phẩm')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Basics</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm danh mục sản phẩm</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm danh mục sản phẩm</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="{{URL::to('/create-category-product.html')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputCatagoryProduct">Tên danh mục</label>
                            <input type="text" class="form-control" name="tenDanhMuc" id="title_slug"
                                onkeyup="ChangeToSlug();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCatagoryProductSlug">Slug</label>
                            <input type="text" class="form-control" id="convert_slug" name="slug_danhmucsanpham">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea class="form-control" rows="4" name="moTaDanhMuc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc danh mục</label>
                            <select class="form-control" name="thuocDanhMuc">
                                <option value="0">---Danh mục cha---</option>
                                @foreach($cate_parent as $key => $cate)
                                <option value="{{$cate->maDanhMuc}}">{{$cate->tenDanhMuc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái</label>
                            <select class="form-control" name="trangThai">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-2"></div>


    </div>

</div>
<!---Container Fluid-->

@endsection