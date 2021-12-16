@extends('frontend.layouts.master',['noDefaultSection' => true],['noslider' => true])
@section('title','Đơn hàng')
@section('styles')
<style>

</style>
@endsection
@section('content')
<div id="customer_orders" class="container">

<h3>Thông tin đơn hàng</h3>

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="order_number">Mã đơn hàng</th>
                <th class="date">Ngày đặt</th>
                <th class="payment_status">Trạng thái thanh toán</th>
                <th class="fulfillment_status">Vận chuyển</th>
                <th class="total">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>

            @foreach($info_order as $key => $order)
            <tr class="odd cancelled_order">
                <td><a href="/account/orders/077bb77757f348149b5e165e964448d9" title="">#1000246976</a></td>
                <td><span>Thg 12 15, 2021</span></td>
                <td><span class="status_pending">pending</span></td>
                <td><span class="status_not fulfilled">not fulfilled</span></td>
                <td><span class="total money">23,990,000₫</span></td>
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

</div>
@endsection