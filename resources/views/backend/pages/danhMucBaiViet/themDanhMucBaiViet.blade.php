@extends('backend.layouts.master')
@section('title','Thêm danh mục bài viết')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Basics</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm danh mục bài viết</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm danh mục bài viết</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="{{URL::to('/create-category-news')}}" method="post">
                    {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputNameProduct">Tên danh mục</label>
                            <input type="text" class="form-control" name="tenDanhMucBaiViet" placeholder="Tên danh mục" id="title_slug" onkeyup="ChangeToSlug();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSlug">SLug</label>
                            <input type="text" class="form-control" id="convert_slug" name="slug_danhMucBaiViet">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputMoTa">Mô tả</label>
                            <textarea class="form-control" id="ckeditor_addProduct" name="moTaDanhMucBaiViet" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-2"></div>


    </div>


</div>
<!---Container Fluid-->
@endsection