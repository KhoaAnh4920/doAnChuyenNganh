@extends('backend.layouts.master')
@section('title','Liệt kê thương hiệu')
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
                <h6 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên thương hiêu</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_brands as $key =>$brand)
                        <tr>
                            <td>{{$brand->maThuongHieu}}</td>
                            <td>{{$brand->tenThuongHieu}}</td>
                            <td>{{$brand->slug}}</td>
                            <td>{{$brand->moTaThuongHieu}}</td>
                            <td><span class="badge badge-success">
                                    @if($brand->trangThai)
                                    @php echo "Hiển thị"; @endphp
                                    @else
                                    @php echo "Ẩn"; @endphp
                                    @endif
                                </span>
                            </td>


                            <td>
                                <a href="{{URL::to('/sua-thuong-hieu.html/'.$brand->maThuongHieu)}}"
                                    class="btn btn-info" role="button"><i class="fa fa-edit text-active"
                                        style="color:#ffffff"></i> Edit</a>
                                <a href="#my-modal_{{$brand->maThuongHieu}}" data-toggle="modal" class="btn btn-danger"
                                    role="button"><i class="fa fa-trash text" style="color:#ffffff"></i>
                                    Delete</a>

                                <div id="my-modal_{{$brand->maThuongHieu}}" class="modal fade" tabindex="-1"
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
                                                                <button type="button" class="btn btn-light text-muted"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger px-4"><a
                                                                        class="btnDeleteUser"
                                                                        href="{{URL::to('/xoa-thuong-hieu.html/'.$brand->maThuongHieu)}}">Delete</a></button>
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

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection