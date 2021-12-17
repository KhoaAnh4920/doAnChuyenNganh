@extends('frontend.layouts.master',['noDefaultSection' => true],['noslider' => true])
@section('title','Đơn hàng')
@section('styles')
<style>
.cart_name_pro a{
    font-size: 20px;
    text-decoration: none;
    color: #000;
}
.cart_name_pro a:hover{

    color: #AA0000;
}
h4.title {
	color: #f95a32;
	margin-bottom: 0.5em;
	font-size: 1.6em;
	line-height: 1.2em;
	background: #F7F7F7;
	padding: 1em;
}
p.noItemCart {
	color: #777;
	font-size: 1.2em;
	line-height: 1.8em;
}
p.noItemCart a {
	text-decoration: underline;
	color: #f95a32;
}
</style>
@endsection
@section('content')
<div id="customer_orders" class="container">

    @if(count($info_order) == 0)
    <div class="container">
        <div class="check-out">
            <h4 class="title">Chưa có đơn hàng</h4>
            <p class="noItemCart">Bạn chưa đặt sản phẩm nào trên website.<br>Click<a
                    href="{{URL::to('/trang-chu.html')}}"> vào đây</a> để mua sắm</p>
        </div>

    </div>
    @else
    <h3>Thông tin đơn hàng</h3>
    <table class="table table-hover" style="margin-top:30px">
        <thead>
            <tr>
                <th class="order_number">Mã đơn hàng</th>
                <th class="date">Ngày đặt</th>
                <th class="payment_status">Trạng thái thanh toán</th>
                <th class="total">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>



            @foreach($info_order as $key => $order)
            <tr class="odd cancelled_order">
                <td><a href="{{URL::to('/checkout-detail.html/'.$order->maDonHang)}}" title="">{{$order->maDonHang}}</a>
                </td>
                <td><span>{{$order->ngayDatHang}}</span></td>
                <td><span class="status_pending">Thanh toán khi nhận hàng</span></td>
                <td><span class="total money">@php echo number_format($order->tongTien) @endphp đ</span></td>
            </tr>
            @endforeach

        </tbody>
        <!-- <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><h4>Tổng cộng</h4></td>
                            <td class="text-right"><h4>{{Cart::subtotal()}} đ</h4></td>
                        </tr>
                        <tr>
                            <td> <button type="button" onclick="location.href='{{URL::to('/delete-item-cart')}}'" class="btn btn-danger">
                                <span class="fa fa-times"></span> Xóa tất cả
                            </button> </td>
                            <td>  </td>
                            <td>  </td>
                            <td>
                            <button type="submit" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Cập nhật
                            </button></td>
                            <td>
                            <button type="button" class="btn btn-success" onclick="location.href='{{URL::to('/order.html')}}'">
                                Thanh toán <span class="fa fa-angle-right"></span>
                            </button></td>
                        </tr>
                    </tfoot> -->
    </table>
    @endif

</div>
@endsection