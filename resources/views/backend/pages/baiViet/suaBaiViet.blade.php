@extends('backend.layouts.master')
@section('title','Sửa bài viết')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa bài viết</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Sửa bài viết</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sửa bài viết</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="{{URL::to('/update-news/'.$edit_news['maBaiViet'])}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputNameProduct">Tiêu đề</label>
                            <input type="text" class="form-control" name="tieuDeBaiViet" value="{{$edit_news['tieuDe']}}" placeholder="Tiêu đề" id="title_slug" onkeyup="ChangeToSlug();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSlug">SLug</label>
                            <input type="text" class="form-control" id="convert_slug" value="{{$edit_news['slug']}}" name="slug_BaiViet">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputMoTa">Mô tả</label>
                            <textarea class="form-control" id="ckeditor_addDescNews" name="moTaBaiViet" rows="4">{{$edit_news['moTa']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputMoTa">Nội dung</label>
                            <textarea class="form-control" id="ckeditor_addContentNews" name="noiDungBaiViet" rows="6">{{$edit_news['noiDung']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputImage">Ảnh thumnail</label>
                            <div class="custom-file">
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="customFile" name="hinhAnh">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img id="blah" style="width:70px; height:70px ;margin-top:5px; margin-bottom:60px"
                                    src="../public/upload/news/{{$edit_news['hinhAnh']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDanhMuc">Thuộc danh mục bài viết</label>
                            <select class="form-control" name="danhMucBaiViet">
                                @foreach($all_category_news as $key => $cate)
                                    <option value="{{$cate->maDanhMuc}}" {{($cate->maDanhMuc == $edit_news['maDanhMuc']) ? 'selected' :''}}>{{$cate->tenDanhMuc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStatus">Trạng thái</label>
                            <select class="form-control" name="trangThai">
                                <option value="0" {{($edit_news['trangThai'] == 0) ? 'selected' :''}}>Ẩn</option>
                                <option value="1" {{($edit_news['trangThai'] == 1) ? 'selected' :''}}>Hiện</option>
                            </select>
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