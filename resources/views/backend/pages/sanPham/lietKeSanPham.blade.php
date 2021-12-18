@extends('backend.layouts.master')
@section('title','Liệt kê sản phẩm')
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

.pagination {
    float: right;
}
</style>
@endsection
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Liệt kê sản phẩm</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Slug</th>
                            <th>Giá</th>
                            <th>Hình</th>
                            <!-- <th>Danh mục hình</th>                    -->
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_products as $key => $pro)
                        <tr>
                            <td>{{$pro->maSanPham}}</td>
                            <td>{{$pro->tenSanPham}}</td>
                            <td>{{$pro->slug}}</td>
                            <td>{{$pro->giaSanPham}}</td>
                            <td>
                                <img style="width:50px;" src="public/upload/products/{{$pro->hinhAnh}}" alt="">
                            </td>
                            <!-- <td><a href="{{URL::to('/liet-ke-danh-muc-hinh.html/'.$pro->maSanPham)}}" style="font-size: 12px;">Thêm danh mục hình</a></td> -->
                            <td>{{$pro->tendanhmuc}}</td>
                            <td>{{$pro->tenthuonghieu}}</td>
                            <td><span class="badge badge-success">

                                    @if($pro->trangThai)
                                    @php echo "Hiển thị"; @endphp
                                    @else
                                    @php echo "Ẩn"; @endphp
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="buttonAction" style="display: inline-flex;">
                                    <a href="{{URL::to('/sua-san-pham.html/'.$pro->maSanPham)}}" class="btn btn-info"
                                        role="button"><i class="fa fa-edit text-active" style="color:#ffffff"></i></a>
                                    <a href="#my-modal_{{$pro->maSanPham}}" style="margin-left:2px" data-toggle="modal"
                                        class="btn btn-danger" role="button"><i class="fa fa-trash text"
                                            style="color:#ffffff"></i></a>

                                    <div id="my-modal_{{$pro->maSanPham}}" class="modal fade" tabindex="-1"
                                        role="dialog" aria-hidden="true">
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
                                                                    <button type="button"
                                                                        class="btn btn-light text-muted"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-danger px-4"><a
                                                                            class="btnDeleteUser"
                                                                            href="{{URL::to('/xoa-san-pham.html/'.$pro->maSanPham)}}">Delete</a></button>
                                                                </div>
                                                                <!-- <div class="col-auto"><button type="button" class="btn btn-danger px-4" data-dismiss="modal">Delete</button></div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>

                        </tr>
                        @endforeach


                    </tbody>


                </table>
                <div class="row" style="margin-top:20px">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to
                            10 of 57 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <!-- <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="dataTable_previous"><a
                                        href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="dataTable"
                                        data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                        data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                        data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                        data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                        data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                        data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                <li class="paginate_button page-item next" id="dataTable_next"><a href="#"
                                        aria-controls="dataTable" data-dt-idx="7" tabindex="0"
                                        class="page-link">Next</a></li>
                            </ul> -->


                            {{ $all_products->links("pagination::bootstrap-4")}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection