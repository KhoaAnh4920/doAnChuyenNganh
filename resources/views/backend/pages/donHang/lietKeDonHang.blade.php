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
                                @php echo "Đơn hàng mới"; @endphp
                                @else
                                @php echo "Đã thanh toán"; @endphp
                                @endif
                            </td>
                            <td>
                                <div class="buttonAction">
                                    <a href="http://localhost:8080/doAnChuyenNganh/chi-tiet-don-hang.html/3"
                                        class="btn btn-success" role="button" style="font-size: 12px;">
                                        <i class="fa fa-eye text-active" style="color:#ffffff;"></i> Xem chi tiết</a>

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