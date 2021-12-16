@extends('frontend.layouts.master',['noDefaultSection' => true],['noslider' => true])
@section('title','Đặt hàng')
@section('styles')
<style>
.section .section-content .content-box {
    box-shadow: 0 0 0 1px #d9d9d9;
    border-radius: 4px;
    background: #fff;
    color: #737373;
    margin-top: 1em;
}

.radio-wrapper .radio-input,
.checkbox-wrapper .checkbox-input {
    display: table-cell;
    padding-right: 0.75em;
    white-space: nowrap;
}

.radio-wrapper .two-page,
.checkbox-wrapper .checkbox-label {
    display: flex;
    cursor: pointer;
    align-items: center;
    padding: 1.3em;
    width: auto;
}

.radio-wrapper .radio-content-input {
    display: flex;
    align-items: center;
}

.blank-slate {
    white-space: pre-line;
    padding: 1.5em;
    text-align: center;
}

.sidebar .sidebar-content .order-summary .product .product-image .product-thumbnail .product-thumbnail-quantity {
    font-size: 0.85714em;
    font-weight: 500;
    white-space: nowrap;
    padding: 0.15em 0.65em;
    border-radius: 2em;
    background-color: rgba(153, 153, 153, 0.9);
    color: #fff;
    position: absolute;
    right: -0.75em;
    top: -0.75em;
    z-index: 2;
}

.visually-hidden {
    border: 0;
    clip: rect(0, 0, 0, 0);
    clip: rect(0 0 0 0);
    width: 2px;
    height: 2px;
    margin: -2px;
    overflow: hidden;
    padding: 0;
    position: absolute;
}
</style>

@endsection
@section('content')

<section id="cart_items">
    <div class="container" style="max-width: 960px">
        <div class="row">

            <div class="col-md-7 order-md-1">
                <h4 class="mb-3">Thông tin giao hàng</h4>
                <form class="needs-validation" action="{{URL::to('/handle-order')}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="total_price" value="{{Cart::subtotal()}}">
                <input type="hidden" name="users_id" value="@php echo Session::get('users_id'); @endphp">
                    @foreach($info_user as $key =>$user)
                    <div class="row">
                        <div class="col-md-12 mb-6">
                            <label for="firstName">Họ tên</label>
                            <input type="text" class="form-control" placeholder="" value="{{$user->users_name}}" name="order_cusName" required="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Email</label>
                            <input type="text" class="form-control" value="{{$user->users_email}}" name="order_cusEmail" required="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Số điện thoại</label>
                            <input type="text" class="form-control" placeholder="" name="order_cusPhone" value="{{$user->users_phone}}" required="">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Địa chỉ nhận hàng</label>
                        <input type="text" class="form-control" placeholder="1234 Main St" name="order_cusAddress" required="">

                    </div>
                    @endforeach


                    <div class="step">

                        <div class="step-sections " step="2">

                            <div id="section-shipping-rate" class="section">
                                <div class="section-header">
                                    <h4 class="mb-3">Phương thức vận chuyển</h4>
                                </div>
                                <div class="section-content">

                                    <div class="content-box">

                                        <div class="content-box-row">
                                            <div class="radio-wrapper"
                                                style="position: relative;padding-top: 10px;vertical-align: middle;padding-left: 10px;">
                                                <label class="radio-label" for="shipping_rate_id_721627">
                                                    <div class="radio-input">
                                                        <input id="shipping_rate_id_721627" class="input-radio"
                                                            type="radio" name="shipping_rate_id" value="721627"
                                                            checked="">
                                                    </div>
                                                    <span class="radio-label-primary" style="display:table-cell">Giao
                                                        hàng tận nơi</span>
                                                    <span class="radio-accessory content-box-emphasis"
                                                        style="float: right;position: absolute;right: 2%;top: 20%;">
                                                        0₫
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div id="section-payment-method" class="section">
                                <div class="section-header">
                                    <h4 class="mb-3">Phương thức thanh toán</h4>
                                </div>
                                <div class="section-content">
                                    <div class="content-box">


                                        <div class="radio-wrapper content-box-row">
                                            <label class="two-page" for="payment_method_id_54606">
                                                <div class="radio-input payment-method-checkbox">
                                                    <input type-id="1" id="payment_method_id_54606" class="input-radio"
                                                        name="payment_method_id" type="radio" value="54606" checked="">
                                                </div>

                                                <div class="radio-content-input">
                                                    <img class="main-img"
                                                        src="https://hstatic.net/0/0/global/design/seller/image/payment/cod.svg?v=1">
                                                    <div class="content-wrapper">
                                                        <span class="radio-label-primary"
                                                            style="margin-left: 10px;">Thanh toán khi giao hàng
                                                            (COD)</span>
                                                        <span class="quick-tagline hidden"></span>
                                                        <span class="quick-tagline  hidden ">Buy Now, Pay Later

                                                        </span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="radio-wrapper content-box-row content-box-row-secondary "
                                            for="payment_method_id_54606">
                                            <div class="blank-slate" style="background-color: #fafafa;">
                                                Là phương thức khách hàng nhận hàng mới trả tiền. Áp dụng với tất cả các
                                                đơn hàng trên toàn quốc
                                            </div>
                                        </div>




                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Đặt hàng</button>
                </form>
            </div>
            <div class="col-md-5 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($cart_content as $key => $cart_pro)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <table class="product-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col"><span class="visually-hidden">Hình ảnh</span></th>
                                    <th scope="col"><span class="visually-hidden">Mô tả</span></th>
                                    <th scope="col"><span class="visually-hidden">Số lượng</span></th>
                                    <th scope="col"><span class="visually-hidden">Giá</span></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="product" data-product-id="1016621180" data-variant-id="1031708031">
                                    <td class="product-image" rowspan=2 style="width: 100px;">
                                        <div class="product-thumbnail">
                                            <div class="product-thumbnail-wrapper">
                                                <img class="product-thumbnail-image"
                                                    alt="{{$cart_pro->options->name}}"
                                                    style="height: 100px;"
                                                    src="{{asset('public/upload/products/')}}/{{$cart_pro->options->image}}">
                                            </div>
                             
                                        </div>
                                    </td>
                                    <td class="product-description" colspan=2>
                                        <span class="product-description-name order-summary-emphasis" style="font-size:16px">{{$cart_pro->name}}</span>

                                    </td>
                                    
                                    
                                </tr>
                                <tr>
                                    <td class="product-quantity"><span style="font-size:13px">SL: {{$cart_pro->qty}}</span> </td>
                                    <td class="product-price">
                                        <span class="order-summary-emphasis" style="float:right">@php echo number_format($cart_pro->price) @endphp đ</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </li>
                    @endforeach
                    


                    <li class="list-group-item d-flex justify-content-between">
                        <span>Tổng cộng: </span>
                        <strong>{{Cart::subtotal()}} đ</strong>
                    </li>
                </ul>

                <!-- <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017-2018 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
</section>
<!--/#cart_items-->

@endsection