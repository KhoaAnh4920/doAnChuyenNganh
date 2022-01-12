@extends('backend.layouts.master')
@section('title','Liệt kê danh mục sản phẩm')
@section('styles')
<style>
.btnClose {
    margin-right: 20px;
}

hr {
    margin-top: 0px;
}

.btnDeleteUser {
    text-decoration: none;
    color: #ffffff;
}

.btnDeleteUser:hover {
    color: #fafafa;
}

@media (max-width: 526px) {
    .card {
        width: unset
    }
}
</style>
@endsection
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh Mục Sản Phẩm</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_category_products as $key =>$category_products)
                        <!-- Danh mục cha -->
                        @if($category_products->danhMucCha == 0) 
                        <tr>
                            <td>{{$category_products->maDanhMuc}}</td>
                            <td>{{$category_products->tenDanhMuc}}</td>
                            <td>{{$category_products->slug}}</td>
                            <td>{{$category_products->moTaDanhMuc}}</td>
                            <td><span class="badge badge-success">
                                @if($category_products->trangThai)
                                    @php echo "Hiển thị"; @endphp
                                @else
                                    @php echo "Ẩn"; @endphp
                                @endif
                                </span>
                            <td>
                                <a href="{{URL::to('/sua-danh-muc-san-pham.html/'.$category_products->maDanhMuc)}}"
                                    class="btn btn-info" role="button"><i class="fa fa-edit text-active"
                                        style="color:#ffffff"></i> Edit</a>
                                <a href="#my-modal_{{$category_products->maDanhMuc}}" data-toggle="modal"
                                    class="btn btn-danger" role="button"><i class="fa fa-trash text"
                                        style="color:#ffffff"></i> Delete</a>

                                <div id="my-modal_{{$category_products->maDanhMuc}}" class="modal fade" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-0">
                                            <div class="modal-body p-0">
                                                <div class="card border-0 p-sm-3 p-2 justify-content-center">
                                                    <div class="card-header pb-0 bg-white border-0 ">

                                                        <div class="row">
                                                            <h4 style="padding:10px 10px 10px 12px">Xác nhận xóa
                                                            </h4>
                                                            <div class="col ml-auto"><button type="button"
                                                                    class="close btnClose" data-dismiss="modal"
                                                                    aria-label="Close"> <span
                                                                        aria-hidden="true">&times;</span> </button>
                                                            </div>

                                                            <hr>
                                                        </div>
                                                        <p class="font-weight-bold mb-2" style="margin-bottom:20px">
                                                            Bạn có muốn xóa không ?</p>

                                                    </div>
                                                    <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                                        <div class="row">
                                                            <hr>
                                                        </div>
                                                        <div class="row justify-content-end no-gutters">
                                                            <div class="col-auto"
                                                                style="float:right; margin-right:20px">
                                                                <button type="button" class="btn btn-light text-muted"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger px-4"><a
                                                                        class="btnDeleteUser"
                                                                        href="{{URL::to('/xoa-danh-muc-san-pham.html/'.$category_products->maDanhMuc)}}">Delete</a></button>
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
                        <!-- Load từng danh mục con trong danh mục cha  -->
                        @foreach($all_category_products as $key => $cate_sub)
                        @if($cate_sub->danhMucCha == $category_products->maDanhMuc)
                        <tr>
                            <td>{{$cate_sub->maDanhMuc}}</td>
                            <td>---{{$cate_sub->tenDanhMuc}}</td>
                            <td>{{$cate_sub->slug}}</td>
                            <td>{{$cate_sub->moTaDanhMuc}}</td>
                            <td><span class="badge badge-success">

                                    @if($cate_sub->trangThai)
                                    @php echo "Hiển thị"; @endphp
                                    @else
                                    @php echo "Ẩn"; @endphp
                                    @endif
                                </span>
                            <td>
                                <a href="{{URL::to('/sua-danh-muc-san-pham.html/'.$cate_sub->maDanhMuc)}}"
                                    class="btn btn-info" role="button"><i class="fa fa-edit text-active"
                                        style="color:#ffffff"></i> Edit</a>
                                <a href="#my-modal_{{$cate_sub->maDanhMuc}}" data-toggle="modal" class="btn btn-danger"
                                    role="button"><i class="fa fa-trash text" style="color:#ffffff"></i> Delete</a>

                                <div id="my-modal_{{$cate_sub->maDanhMuc}}" class="modal fade" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-0">
                                            <div class="modal-body p-0">
                                                <div class="card border-0 p-sm-3 p-2 justify-content-center">
                                                    <div class="card-header pb-0 bg-white border-0 ">

                                                        <div class="row">
                                                            <h4 style="padding:10px 10px 10px 12px">Xác nhận xóa
                                                            </h4>
                                                            <div class="col ml-auto"><button type="button"
                                                                    class="close btnClose" data-dismiss="modal"
                                                                    aria-label="Close"> <span
                                                                        aria-hidden="true">&times;</span> </button>
                                                            </div>

                                                            <hr>
                                                        </div>
                                                        <p class="font-weight-bold mb-2" style="margin-bottom:20px">
                                                            Bạn có muốn xóa không ?</p>

                                                    </div>
                                                    <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                                        <div class="row">
                                                            <hr>
                                                        </div>
                                                        <div class="row justify-content-end no-gutters">
                                                            <div class="col-auto"
                                                                style="float:right; margin-right:20px">
                                                                <button type="button" class="btn btn-light text-muted"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger px-4"><a
                                                                        class="btnDeleteUser"
                                                                        href="{{URL::to('/xoa-danh-muc-san-pham.html/'.$cate_sub->maDanhMuc)}}">Delete</a></button>
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
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection