@extends('backend.layouts.master')
@section('title','Liệt kê chi tiết đơn hàng')
@section('content')

<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:groove;
}
</style>
<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
        <div class="card mb-4">
             <h1 style="text-align: center;"><b>THÔNG TIN CHI TIẾT ĐƠN HÀNG</b>  </h1>
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary" style="text-aligin=center">THÔNG TIN ĐƠN HÀNG</h6>
                <h6 class="m-0 font-weight-bold text-primary"><p>NGÀY ĐẶT: {{$order_by_id->ngayDatHang}}</p></td></h6>
            </div>
            
            <table style="width:100%;">
            <tr>
                <th class="m-0 font-weight-bold text-primary" style="text-align: center;" >Thông tin khách hàng</th>
                <th class="m-0 font-weight-bold text-primary" style="text-align: center;">Địa chỉ nhận hàng</th>
                <th class="m-0 font-weight-bold text-primary" style="text-align: center;">Trạng thái đơn hàng</th>
            </tr>
            <br>
            <tr>
                <td><b style="color:red;">Tên khách hàng:</b>  {{$order_by_id->tenNguoiNhanHang}}</Tên>
                <p><b style="color:red;"> Số điện thoại: </b>{{$order_by_id->soDienThoai}}</p>
                <td style="text-align: center;"><p>{{$order_by_id->diaChiGiaoHang}}</p></td>
                <td style="text-align: center;"><p>
                    @if($order_by_id->trangThaiDonHang == 0) Đơn hàng mới
                    @elseif($order_by_id->trangThaiDonHang == 1) Đang giao hàng
                    @elseif($order_by_id->trangThaiDonHang == 2) Đã giao hàng
                    @else Đã hủy @endif
                </p></td>
            </tr>
            </table>
            <tfoot>
                        <tr>
                            <td colspan=2>
                                <form action="{{URL::to('/update-status-order')}}" method="post" role="form">
                                {!! csrf_field() !!}
                                    <input type="hidden" name="id_order" value="{{$order_by_id->maDonHang}}">
                                    <div class="form-group" data-select2-id="11" style="margin-top:10px" >
                                        <label for="select2SinglePlaceholder" class="m-0 font-weight-bold text-primary" style="display: block;">Trạng thái đơn hàng</label>
                                        <select
                                            class="select2-single-placeholder form-control select2-hidden-accessible"
                                            name="state_order" id="select2SinglePlaceholder"
                                            data-select2-id="select2SinglePlaceholder" tabindex="-1"
                                            style="width: 10%; display: inline-table;" aria-hidden="true">
                                            <option value="0" @if($order_by_id->trangThaiDonHang == 0) selected @endif >Đơn hàng mới</option>
                                            <option value="1" @if($order_by_id->trangThaiDonHang == 1) selected @endif>Đang giao hàng</option>
                                            <option value="2" @if($order_by_id->trangThaiDonHang == 2) selected @endif>Đã giao hàng</option>
                                            <option value="3" @if($order_by_id->trangThaiDonHang == 3) selected @endif >Hủy đơn hàng</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary" style="display: inline-table;">Cập
                                            nhật</button>
                                    </div>
                                </form>
                           
                                

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    </tfoot>
                    <br>
            <hr>
            <div class="cus_order" style="padding-left: 15px">
                
                <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin đơn hàng</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; $tongTien = 0 @endphp
                        @foreach($order_detail as $key => $order)
                        @php $i++ @endphp
                        <tr>
                            </td>
                            <td>{{$i}}</td>
                            <td><span class="text-ellipsis">{{$order->tensanpham}}</span></td>
                            <td><span class="text-ellipsis">{{$order->giaSanPham}}</span></td>
                            <td>
                                <span class="text-ellipsis">{{$order->soLuong}}</span>

                                <input type="hidden" name="order_id" class="order_code" value="{{$order->maDonHang}}">
                                <input type="hidden" name="order_product_id" class="order_product_id"
                                    value="{{$order->maSanPham}}">
                            </td>
                            <td><span class="text-ellipsis">
                                    @php
                                    $gia = $order->giaSanPham;
                                    $sl = $order->soLuong;
                                    $sum = $gia * $sl;
                                    $tongTien += $sum;
                                    echo number_format($sum);
                                    @endphp
                                </span> VNĐ</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="m-0 font-weight-bold text-primary">Tổng thành tiền </td>
                            <td colspan=4>@php echo number_format($tongTien) @endphp VNĐ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
            </div>

        </div>
    </div>

    
</div>

@endsection