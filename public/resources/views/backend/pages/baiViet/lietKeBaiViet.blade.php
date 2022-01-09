@extends('backend.layouts.master')
@section('title','Liệt kê bài viết')
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
                            <th>Tiêu đề</th>
                            <th>Slug</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Tác giả</th>
                            <th>Ngày đăng</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_news as $key => $news)
                        <tr>
                            <td>{{$news->maBaiViet}}</td>
                            <td>{{$news->tieuDe}}</td>
                            <td>{{$news->slug}}</td>
                            <td>
                                <img style="width:100px;" src="public/upload/news/{{$news->hinhAnh}}" alt="">
                            </td>
                            <td>{{$news->tenDanhMuc}}</td>
                            <td>{{$news->users_name}}</td>
                            <td>{{$news->created_at}}</td>
                            <td>

                                @if($news->trangThai== 1)
                                <span class="badge badge-success">Hiển thị</span>
                                @else
                                <span class="badge badge-danger">Ẩn</span>
                                @endif


                            </td>
                            <td>
                                <div class="buttonAction" style="display: inline-flex;">
                                    <a href="{{URL::to('/sua-bai-viet.html/'.$news->maBaiViet)}}"
                                        class="btn btn-info" role="button"><i class="fa fa-edit text-active"
                                            style="color:#ffffff"></i></a>
                                    <a href="#my-modal_{{$news->maBaiViet}}" style="margin-left:2px" data-toggle="modal"
                                        class="btn btn-danger" role="button"><i class="fa fa-trash text"
                                            style="color:#ffffff"></i></a>

                                    <div id="my-modal_{{$news->maBaiViet}}" class="modal fade" tabindex="-1"
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
                                                                            href="{{URL::to('/xoa-bai-viet.html/'.$news->maBaiViet)}}">Delete</a></button>
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

                            {{ $all_news->links("pagination::bootstrap-4")}}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection