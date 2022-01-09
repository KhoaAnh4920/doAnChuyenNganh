@extends('frontend.layouts.master',['noDefaultSection' => true],['noslider' => true])
@section('title','Đơn hàng')
@section('styles')
<style>

</style>
@endsection
@section('content')
<div id="customer_orders" class="container">

    <h3>Sản phẩm đã đặt</h3>

    <table class="table table-hover" style="margin-top:30px">
        <thead>
            <tr>
                <th class="order_stt">STT</th>
                <th class="order_image_pro">Hình</th>
                <th class="order_number">Tên Sản phẩm</th>
                <th class="date">Số lượng</th>
                <th class="payment_status">Giá</th>
                <th class="total">Tổng cộng</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0 @endphp
            @foreach($detail_order as $key => $order)
            @php $i++ @endphp
            <tr class="odd cancelled_order">
                <td><span>@php echo $i @endphp</span></td>
                <td><img class="media-object" src="{{asset('public/upload/products/')}}/{{$order->hinhAnh}}"
                        style="height: 60px;"></td>
                <td>{{$order->tenSanPham}}</td>
                <td><span>{{$order->soLuong}}</span></td>
                <td><span class="status_pending">{{$order->giaSanPham}}</span></td>
                <td><span class="total money">
                    @php
                        $sum = $order->giaSanPham * $order->soLuong;
                        echo number_format($sum);
                    @endphp 
                    đ
                    </span></td>
            </tr>

            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h4>Tổng tiền</h4>
                </td>
                <td class="text-left">
                    <h4>{{$tongTien->tongTien}} đ</h4>
                </td>
            </tr>

        </tfoot>
    </table>

</div>
@endsection