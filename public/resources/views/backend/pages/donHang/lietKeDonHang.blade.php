@extends('backend.layouts.master')
@section('title','Liệt kê đơn hàng')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Liệt kê đơn hàng</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>Tên người nhận</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_order as $key => $order)
                        <tr>
                            <td>{{$order->maDonHang}}</td>
                            <td><span class="text-ellipsis">{{$order->tenNguoiNhanHang}}</span></td>
                            <td>{{$order->diaChiGiaoHang}}</td>
                            <td><span class="text-ellipsis">{{$order->soDienThoai}}</span></td>
                            <td>{{$order->ngayDatHang}}</td>
                            <td>@php echo number_format($order->tongTien) @endphp VNĐ</td>
                            <td>
                                
                                    @if($order->trangThaiDonHang == 0)
                                        <span class="badge badge-info">Đơn hàng mới</span>
                                    @elseif($order->trangThaiDonHang == 1)
                                        <span class="badge badge-warning">Đang giao hàng</span>
                                    @elseif($order->trangThaiDonHang == 2)
                                        <span class="badge badge-success">Đã giao hàng</span>
                                    @else
                                        <span class="badge badge-danger">Hủy đơn hàng</span>
                                    @endif

                                
                            </td>
                            <td>
                                <div class="buttonAction">
                                    <a href="{{URL::to('/chi-tiet-don-hang.html/'.$order->maDonHang)}}"
                                        class="btn btn-sm btn-primary">Detail</a>
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