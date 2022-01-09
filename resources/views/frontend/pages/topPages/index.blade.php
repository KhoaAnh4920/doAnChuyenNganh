@extends('frontend.layouts.master')
@section('title','Trang chủ')
@section('styles')
<style>
.box-common__title {
    float: left;
    font-size: 18px;
    font-weight: bold;
    line-height: 29px;
    width: 32%;
}
.box-common__top {
    margin-bottom: 15px;
}
.box-common__link {
    float: right;
    font-size: 0;
    text-align: right;
    margin-top:10px;
    width: 68%;
}
.box-common__link a {
    border: 1px solid #e0e0e0;
    border-radius: 16px;
    color: #333;
    display: inline-block;
    font-size: 13px;
    line-height: 10px;
    margin-left: 10px;
    padding: 10px 11px;
}
.title a{
    display: block;
    position: absolute;
    left:38%;
    top:-25px;
    background-image: linear-gradient(to right top, #fae939, #ffca1c, #ffab0b, #ff8a12, #fc6721);
    padding: 10px 10px;
    border-radius: 50px;
    color: #fafafa;
    text-transform: uppercase;
    text-decoration: none;
}
.gach-ngang {
    position: relative;
    margin-top: 20px;
    /* margin-top: 50px; */
    margin-bottom: 10px;
}
</style>
@endsection
@section('defaultContent')
<div class="col-sm-9 padding-right">						
    
    <div class="category-tab">
        <!--Điện thoại nổi bật-->
        <div class="col-sm-12">
            <div class="box-common__top clearfix">
                <h2 class="box-common__title">ĐIỆN THOẠI NỔI BẬT NHẤT</h2>

                <div class="box-common__link" data-size="3">
                    @foreach($danhMucConDienThoai as $key => $cate_child)
                    <a href="{{URL::to('/category-product.html/'.$cate_child->slug)}}" data-index="1">
                        {{$cate_child->tenDanhMuc}}
                    </a>
                    @endforeach
        
                    <a class="readmore-btn" href="{{URL::to('/category-product.html/'.'dien-thoai')}}">Xem tất cả <b>{{$countdanhSachDienThoai->sl}}</b> Điện thoại</a>
                </div> 
            </div>
                @foreach($danhSachDienThoai as $key => $ds)
                <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                <a href="{{URL::to('/product-details.html/'.$ds->slug)}}"><img style="width:200px" src="{{asset('public/upload/products/')}}/{{$ds->hinhAnh}}" alt="{{$ds->hinhAnh}}" /></a>
                                    <h2>{{number_format($ds->giaSanPham)}} VNĐ</h2>
                                    <a href="{{URL::to('/product-details.html/'.$ds->slug)}}"><p>{{$ds->tenSanPham}}</p></a>
                                    <a href="{{URL::to('/product-details.html/'.$ds->slug)}}" class="btn btn-default add-to-cart">Chi tiết <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach
        </div>

        
    </div>
    <!--End Điện thoại nổi bật-->

    <div class="category-tab">
        <!--Laptop nổi bật-->
        <div class="col-sm-12">
            <div class="box-common__top clearfix">
                <h2 class="box-common__title">LAPTOP NỔI BẬT NHẤT</h2>

                <div class="box-common__link" data-size="3">
                    @foreach($danhMucConLaptop as $key => $cate_child_lap)
                    <a href="{{URL::to('/category-product.html/'.$cate_child_lap->slug)}}" data-index="1">
                        {{$cate_child_lap->tenDanhMuc}}
                    </a>
                    @endforeach
        
                    <a class="readmore-btn" href="{{URL::to('/category-product.html/'.'laptop')}}">Xem tất cả <b>{{$countdanhSachLaptop->sl}}</b> Laptop</a>
                </div> 
            </div>
                @foreach($danhSachLaptop as $key => $dsLap)
                <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                <a href="{{URL::to('/product-details.html/'.$dsLap->slug)}}"><img style="width:200px" src="{{asset('public/upload/products/')}}/{{$dsLap->hinhAnh}}" alt="{{$dsLap->hinhAnh}}" /></a>
                                    <h2>{{number_format($dsLap->giaSanPham)}} VNĐ</h2>
                                    <a href="{{URL::to('/product-details.html/'.$dsLap->slug)}}"><p>{{$dsLap->tenSanPham}}</p></a>
                                    <a href="{{URL::to('/product-details.html/'.$dsLap->slug)}}" class="btn btn-default add-to-cart">Chi tiết <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach
        </div>

        
    </div>
    <!--Laptop nổi bật-->

    <div class="recommended_items" >
        <!--recommended_items-->
        <div class="gach-ngang">
            <h2 class="title text-center"><a href="#">Sản phẩm bán chạy</a> </h2>
        </div>
        
        

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel" style="margin-top:65px">
            <div class="carousel-inner">
            @php $dem = 0 @endphp
                @foreach($recommmendedProducts as $key => $pre_pro)
                    @php
                        if($dem == 0)
                            echo " <div class='item active'>";
                        else if($dem == 3)
                            echo " <div class='item'>";
                    @endphp
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{URL::to('/product-details.html/'.$pre_pro->slug)}}"><img style="width:200px" src="{{asset('public/upload/products/')}}/{{$pre_pro->hinhAnh}}" alt="{{$pre_pro->tenSanPham}}" /></a>
                                    <h2>{{number_format($pre_pro->giaSanPham)}} VNĐ</h2>
                                    <a href="{{URL::to('/product-details.html/'.$pre_pro->slug)}}"><p>{{$pre_pro->tenSanPham}}</p></a>         
                                    <a href="{{URL::to('/product-details.html/'.$pre_pro->slug)}}" class="btn btn-default add-to-cart">Chi tiết <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php if($dem == 2 || $dem == (count($recommmendedProducts) -1)) 
                        echo "</div>";
                    @endphp
                    @php $dem++  @endphp
                @endforeach
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!--/recommended_items-->
</div>
@endsection