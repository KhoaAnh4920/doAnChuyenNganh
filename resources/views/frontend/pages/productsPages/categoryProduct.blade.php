@extends('frontend.layouts.master',['noslider' => true])
@section('title','Sản phẩm')
@section('advertisement')
<div class="container mb-4">
    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner row">
            @php $i= 1 @endphp
            @foreach($all_slider as $key => $slide)

            <div class="item {{($i == 1) ? 'active' : ''}} col-sm-12">
                <img src="{{asset('public/upload/slider/')}}/{{$slide->hinhAnh}}" style="width:100%" class="img-fluid"
                    alt="" />
            </div>
            @php $i++ @endphp
            @endforeach

        </div>
    @if(count($all_slider) > 1)
        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    @endif
    </div>
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
                    <a href="{{URL::to('/product-details.html/'.$pro->slug)}}"><img style="width:200px"
                            src="{{asset('public/upload/products/')}}/{{$pro->hinhAnh}}" alt="{{$pro->hinhAnh}}" /></a>
                    <h2>{{number_format($pro->giaSanPham)}} VNĐ</h2>
                    <a href="{{URL::to('/product-details.html/'.$pro->slug)}}">
                        <p>{{$pro->tenSanPham}}</p>
                    </a>
                    <a href="{{URL::to('/product-details.html/'.$pro->slug)}}" class="btn btn-default add-to-cart">Chi
                        tiết <i class="fa fa-arrow-right"></i></a>
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

    <!-- Gọi hàm phân trang -->
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {{ $product_of_cate->render()}}
    </ul>

</div>
<!--features_items-->
@endsection