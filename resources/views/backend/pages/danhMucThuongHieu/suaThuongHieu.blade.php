@extends('backend.layouts.master')
@section('title','Sửa thương hiệu')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Basics</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật thương hiệu</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cập nhật thương hiệu</h6>
                </div>
                <div class="card-body">
                @foreach($edit_brand as $key => $brand)
                    <form role="form" method="post" action="{{URL::to('/update-brand.html/'.$brand->maThuongHieu)}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputNameBrand">Tên thương hiệu</label>
                            <input type="text" class="form-control" name="tenThuongHieu"
                                value="{{$brand->tenThuongHieu}}" id="title_slug" onkeyup="ChangeToSlug();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCatagoryBrandSlug">Slug</label>
                            <input type="text" class="form-control" id="convert_slug" value="{{$brand->slug}}"
                                name="slug_thuonghieu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputBrand_Des">Mô tả</label>
                            <textarea class="form-control" rows="4"
                                name="moTaThuongHieu">{{$brand->moTaThuongHieu}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái</label>
                            <select class="form-control" name="trangThai">
                                <option value="0" {{($brand->trangThai == 0) ? 'selected': ''}}>Ẩn</option>
                                <option value="1" {{($brand->trangThai == 1) ? 'selected': ''}}>Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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