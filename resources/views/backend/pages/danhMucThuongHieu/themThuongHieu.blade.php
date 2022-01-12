@extends('backend.layouts.master')
@section('title','Thêm thương hiệu')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Thương Hiệu</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Thêm thương hiệu</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm thương hiệu</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="{{URL::to('/create-brand.html')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputNameBrand">Tên thương hiệu</label>
                            <input type="text" class="form-control" id="title_slug" onkeyup="ChangeToSlug();" name="tenThuongHieu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCatagoryBrandSlug">Slug</label>
                            <input type="text" class="form-control" id="convert_slug" name="slug_thuonghieu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea class="form-control" rows="4" name="moTaThuongHieu"></textarea>
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