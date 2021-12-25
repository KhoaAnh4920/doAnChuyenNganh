@extends('backend.layouts.master')
@section('title','Slider')
@section('styles')
<style>
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
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách slider</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách slider</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Hình Ảnh</th>
                                <th>Tên</th>
                                <th>Username</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_slider as $key => $slide)
                            <tr>
                                <td style="vertical-align: middle;">{{$slide->maSlider}}</td>
                                <td style="vertical-align: middle;"><img width="120px" height="500px"
                                        src="public/upload/slider/{{$slide->hinhAnh}}" alt="{{$slide->hinhAnh}}">
                                </td>
                                <td style="vertical-align: middle;">{{$slide->tenSlider}}</td>
                                <td style="vertical-align: middle;">{{$slide->moTa}}</td>
                                <td style="vertical-align: middle;">

                                    @if($slide->trangThai == 1)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-danger">Ẩn</span>
                                    @endif

                                </td>
                                <!-- <td style="vertical-align: middle;"><a href="#" class="btn btn-sm btn-primary">Detail</a></td> -->
                                <td style="vertical-align: middle;">
    
                                    <a href="#my-modal_{{$slide->maSlider}}" data-toggle="modal" class="btn btn-danger"
                                        role="button"><i class="fa fa-trash  text" style="color:#ffffff"></i>
                                        Delete</a>

                                    <div id="my-modal_{{$slide->maSlider}}" class="modal fade" tabindex="-1"
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
                                                                            href="{{URL::to('/delete-slider/'.$slide->maSlider)}}">Delete</a></button>
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
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <!--Row-->
    

</div>
<!---Container Fluid-->
@endsection