@extends('backend.layouts.master')
@section('title','Thêm slider')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm slider</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm slider</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm slider</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="{{URL::to('/create-slider')}}" method="post"
                        enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slider</label>
                            <input type="text" class="form-control" name="slider_name" placeholder="Tên slider">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone">Hình ảnh</label>
                            <div class="custom-file"> 
                                <input type="file" onchange="readURL(this);" class="custom-file-input" required id="customFile" name="slider_img">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img id="blah" style="width:200px; height:80px ;margin-top:5px; margin-bottom:60px" src="https://longvanidc.vn/hinhanh/no_image_available.jpeg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea class="form-control" id="ckeditor_addSliderDesc" name="slider_desc" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Vị trí slider: </label>
                            <select name="slider_pos">
                                <option value="0" selected>Trang chủ</option>
                                <option value="1">Danh mục sản phẩm</option>
                                <option value="2">Danh mục thương hiệu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slider_status">Trạng thái: </label>
                            <select name="slider_status">
                                <option value="0" selected>Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-3"></div>

    </div>

</div>
<!---Container Fluid-->
@endsection