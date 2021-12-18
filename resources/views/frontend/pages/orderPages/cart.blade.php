@extends('frontend.layouts.master',['noslidebar' => true],['noslider' => true])
@section('title','Giỏ hàng')
@section('styles')
<style>
.cart_name_pro a {
    font-size: 20px;
    text-decoration: none;
    color: #000;
}

.cart_name_pro a:hover {

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
<section id="cart_items">
    <div class="container">
        <!--Start breadcrumbs-->
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <!--End breadcrumbs-->
        <!-- <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{asset('public/frontend/images/cart/one.png')}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                    autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{asset('public/frontend/images/cart/two.png')}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                    autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{asset('public/frontend/images/cart/three.png')}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                    autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> -->

        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                @if(Cart::count() == 0)

                <div class="container">
                    <div class="check-out">
                        <h4 class="title">Giỏ hàng chưa có sản phẩm</h4>
                        <p class="noItemCart">Bạn chưa có sản phẩm nào trong giỏ hàng.<br>Click<a
                                href="{{URL::to('/trang-chu.html')}}"> vào đây</a> để mua sắm</p>
                    </div>

                </div>
                @else
                <form action="{{URL::to('/update-cart')}}" method='post'>
                    {!! csrf_field() !!}
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th class="text-center">Giá</th>
                                <th class="text-center">Tổng</th>

                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($contentCart as $key => $cart_pro)
                            <tr>
                                <td class="col-sm-8 col-md-8">
                                    <div class="media">
                                        <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                src="{{asset('public/upload/products/')}}/{{$cart_pro->options->image}}"
                                                style="height: 100px;"> </a>
                                        <div class="media-body">
                                            <h4 class="media-heading cart_name_pro"><a href="{{URL::to('/product-details.html/'.$cart_pro->options->slug_Pro)}}">{{$cart_pro->name}}</a>
                                            </h4>
                                            <h5 class="media-heading"> Danh mục: <a
                                                    href="{{URL::to('/category-product.html/'.$cart_pro->options->slug_Cate)}}">{{$cart_pro->options->category}}</a></h5>
                                            <h5 class="media-heading"> Thương hiệu: <a
                                                    href="{{URL::to('/brands-product.html/'.$cart_pro->options->slug_Brand)}}">{{$cart_pro->options->brand}}</a></h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart_quantity col-sm-1 col-md-1">
                                    <input type="number" name="quanlity[{{$cart_pro->rowId}}]"
                                        class="form-control quantity" min="1" max="100" value="{{$cart_pro->qty}}">
                                </td>
                                <td class="col-sm-1 col-md-1 text-center price"><strong>@php echo
                                        number_format($cart_pro->price) @endphp đ</strong></td>
                                <td class="col-sm-1 col-md-1 text-center total_price"><strong>
                                        @php
                                        $sum = $cart_pro->price * $cart_pro->qty;
                                        echo $sum;
                                        @endphp
                                        đ
                                    </strong></td>
                                <td class="col-sm-1 col-md-1">
                                    <button type="button"
                                        onclick="location.href='{{URL::to('/delete-item-cart/'.$cart_pro->rowId)}}'"
                                        class="btn btn-danger">
                                        <span class="fa fa-times"></span> Xóa
                                    </button>



                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h4>Tổng cộng</h4>
                                </td>
                                <td class="text-right">
                                    <h4>{{Cart::subtotal()}} đ</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- <button type="button" onclick="location.href='{{URL::to('/delete-item-cart')}}'"
                                        class="btn btn-danger">
                                        <span class="fa fa-times"></span> Xóa tất cả
                                    </button> -->

                                    <a href="#my-modal" data-toggle="modal" class="btn btn-danger" role="button"><i
                                            class="fa fa-trash text" style="color:#ffffff"></i><span class="fa fa-times"></span> Xóa tất cả</a>

                                    <div id="my-modal" class="modal fade" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content border-0">
                                                <div class="modal-body p-0">
                                                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                                                        <div class="card-header pb-0 bg-white border-0 ">

                                                            <div class="row">
                                                                <div class="col ml-auto"><button type="button"
                                                                        class="close btnClose" data-dismiss="modal"
                                                                        aria-label="Close"> <span
                                                                            aria-hidden="true">&times;</span> </button>
                                                                </div>
                                                                <h4 style="padding:10px 10px 10px 12px">Chú ý
                                                                </h4>
                                                                <hr>
                                                            </div>
                                                            <p class="font-weight-bold mb-2" style="font-size:16px">
                                                            Bạn có muốn xoá tất cả sản phẩm ra khỏi giỏ hàng?</p>

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
                                                                            class="btnDeleteUser" style="color: #fff; text-decoration: none;"
                                                                            href="{{URL::to('/delete-item-cart')}}">Delete</a></button>
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
                                <td> </td>
                                <td> </td>
                                <td>
                                    <button type="submit" class="btn btn-default">
                                        <span class="fa fa-shopping-cart"></span> Cập nhật
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success"
                                        onclick="location.href='{{URL::to('/order.html')}}'">
                                        Thanh toán <span class="fa fa-angle-right"></span>

                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>
<!--/#cart_items-->

<!-- <section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--/#do_action-->

@endsection