@extends('frontend.layouts.master',['noslider' => true])
@section('title','Kết quả tìm kiếm')
@section('advertisement')
<div class="container mb-4">
    <img src="{{asset('public/frontend/images/shop/advertisement.jpg')}}" alt="" />
</div>
<br>
@endsection
@section('defaultContent')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">{{$result_search->total()}} sản phẩm được tìm thấy</h2>


    @if(count($result_search) > 0)
        @foreach($result_search as $key => $pro)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                    <a href="{{URL::to('/product-details.html/'.$pro['slug'])}}"><img style="width:200px" src="{{asset('public/upload/products/')}}/{{$pro['hinhAnh']}}" alt="{{$pro['hinhAnh']}}" /></a>
                        <h2>{{number_format($pro['giaSanPham'])}} VNĐ</h2>
                        <a href="{{URL::to('/product-details.html/'.$pro['slug'])}}"><p>{{$pro['tenSanPham']}}</p></a>
                        <a href="{{URL::to('/product-details.html/'.$pro['slug'])}}" class="btn btn-default add-to-cart">Chi tiết <i class="fa fa-arrow-right"></i></a>
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
            {!! $result_search->appends(Request::except('page'))->render() !!}
    </ul>
    
</div>
<!--features_items-->
@endsection