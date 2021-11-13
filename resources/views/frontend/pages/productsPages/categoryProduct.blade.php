@extends('frontend.layouts.master',['noslider' => true])
@section('title','Sản phẩm')
@section('advertisement')
<div class="container mb-4">
    <img src="{{asset('public/frontend/images/shop/advertisement.jpg')}}" alt="" />
</div>
<br>
@endsection
@section('defaultContent')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Sản phẩm của hãng A</h2>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                <a href="{{URL::to('/product-details.html')}}"><img src="{{asset('public/frontend/images/shop/product12.jpg')}}" alt="" /></a>
                    <h2>$56</h2>
                    <a href="{{URL::to('/product-details.html')}}"><p>Easy Polo Black Edition</p></a>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                <a href="{{URL::to('/product-details.html')}}"><img src="{{asset('public/frontend/images/shop/product11.jpg')}}" alt="" /></a>
                    <h2>$56</h2>
                    <a href="{{URL::to('/product-details.html')}}"><p>Easy Polo Black Edition</p></a>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                <a href="{{URL::to('/product-details.html')}}"><img src="{{asset('public/frontend/images/shop/product10.jpg')}}" alt="" /></a>
                    <h2>$56</h2>
                    <a href="{{URL::to('/product-details.html')}}"><p>Easy Polo Black Edition</p></a>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>




    <ul class="pagination">
        <li class="active"><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
        <li><a href="">&raquo;</a></li>
    </ul>
</div>
<!--features_items-->
@endsection