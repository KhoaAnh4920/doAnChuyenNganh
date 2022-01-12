@extends('backend.layouts.master')
@section('title','Sửa slider')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Sửa Silder</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sửa Slider</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="{{URL::to('/update-slider/'.$edit_slider->maSlider)}}" method="post"
                        enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" class="form-control" name="slider_id" readonly
                                value="{{$edit_slider->maSlider}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slider</label>
                            <input type="text" class="form-control" name="slider_name" placeholder="Tên slider" value="{{$edit_slider->tenSlider}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone">Hình ảnh</label>
                            <div class="custom-file"> 
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="customFile" name="slider_img">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img id="blah" style="width:200px; height:80px ;margin-top:5px; margin-bottom:60px" src="../public/upload/slider/{{$edit_slider->hinhAnh}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea class="form-control" id="ckeditor_addSliderDesc" name="slider_desc" rows="4">{{$edit_slider->moTa}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Vị trí slider: </label>
                            <select name="slider_pos">
                                <option value="0" {{($edit_slider->viTri == 0) ? "selected" : ''}}>Trang chủ</option>
                                <option value="1" {{($edit_slider->viTri == 1) ? "selected" : ''}}>Danh mục sản phẩm</option>
                                <option value="2" {{($edit_slider->viTri == 2) ? "selected" : ''}}>Danh mục thương hiệu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slider_status">Trạng thái: </label>
                            <select name="slider_status">
                                <option value="0" {{(!$edit_slider->trangThai) ? "selected" : ''}} >Ẩn</option>
                                <option value="1" {{($edit_slider->trangThai) ? "selected" : ''}}>Hiển thị</option>
                            </select>
                        </div>
 
                        <button type="submit" class="btn btn-primary" style="margin-top:30px">Cập nhật</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-2"></div>


    </div>

</div>
<!---Container Fluid-->

@endsection