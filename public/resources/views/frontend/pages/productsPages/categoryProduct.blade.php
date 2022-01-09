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
    @foreach($name_product as $key => $name)
    <h2 class="title text-center">{{$name->tenDanhMuc}}</h2>
    @endforeach

    @if(count($product_of_cate) > 0)
        @foreach($product_of_cate as $key => $pro)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                    <a href="{{URL::to('/product-details.html/'.$pro->slug)}}"><img style="width:200px" src="{{asset('public/upload/products/')}}/{{$pro->hinhAnh}}" alt="{{$pro->hinhAnh}}" /></a>
                        <h2>{{number_format($pro->giaSanPham)}} VNĐ</h2>
                        <a href="{{URL::to('/product-details.html/'.$pro->slug)}}"><p>{{$pro->tenSanPham}}</p></a>
                        <a href="{{URL::to('/product-details.html/'.$pro->slug)}}" class="btn btn-default add-to-cart">Chi tiết <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="col-sm-12">
            <h3>Chưa có sản phẩm</h3>
        </div>
    @endif


    <div class="clearfix"></div>


    <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $product_of_cate->render()}}
    </ul>
    
</div>
<!--features_items-->
@endsection