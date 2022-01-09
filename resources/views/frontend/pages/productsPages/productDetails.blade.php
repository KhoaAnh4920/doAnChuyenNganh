@extends('frontend.layouts.master',['noslider' => true], ['noslidebar' => true])
@section('title','Sản phẩm')
@section('advertisement')
@section('defaultContent')
<div class="col-sm-12">

    @foreach($detail_pro as $key => $pro)
    <div class="product-details">
        <!--product-details-->
        <div class="col-sm-5">
            <ul id="imageGallery">
                @foreach($gallery_pro as $key => $gall)
                <li data-thumb="{{asset('public/upload/gallery/')}}/{{$gall->hinh}}"
                    data-src="{{asset('public/upload/gallery/')}}/{{$gall->hinh}}">
                    <img style="width:100%;" src="{{asset('public/upload/gallery/')}}/{{$gall->hinh}}" />
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-7">
            <div class="product-information">
                <form action="{{URL::to('/add-to-cart.html')}}" method='post' id="{{$pro->maSanPham}}">
                {!! csrf_field() !!}
                <input type='hidden' name='product_id' value='{{$pro->maSanPham}}'>
                    <!--/product-information-->
                    <img src="{{asset('public/frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />

                    <h2>{{$pro->tenSanPham}} </h2>
                    <p>Mã Sản phẩm: {{$pro->maSanPham}}</p>
                    <span>
                        <span>{{number_format($pro->giaSanPham)}} VNĐ</span>
                        
                    </span>
                    <div>
                    <label>Số lượng:</label>
                        <input style="padding: 6px 12px; height:32px " type="number" name="qty_pro" value="1" min="1" max="100" />
                        <button type="submit" class="btn btn-fefault cart" style="height:32px">
                            <i class="fa fa-shopping-cart"></i>
                            Thêm giỏ hàng
                        </button>
                    </div>
                    <hr>

                    <!-- <ul style="border-top: 1px solid #ebebeb; padding-top: 40px; margin-top: 50px;">
                            <li><b>Tình trạng</b> <span>Còn hàng</span></li>
                            <li><b>Vận chuyển</b> <span>01 ngày. <samp>Miễn phí vận chuyển</samp></span></li>
                            <li><b>Trọng lượng</b> <span>0.5 kg</span></li>
                            <li><b>Chia sẻ</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul> -->
                    
                    <p><b>Trạng thái: </b> {{$pro->trangThai == 1 ? 'Còn hàng' : 'Hết hàng'}}</p>
                    <p><b>Danh mục: </b>{{$pro->tendanhmuc}}</p>
                    <p><b>Hãng: </b>{{$pro->tenthuonghieu}}</p>
                    <a href=""><img src="{{asset('public/frontend/images/product-details/share.png')}}"
                            class="share img-responsive" alt="" /></a>
                </form>
            </div>
            <!--/product-information-->
        </div>
    </div>
    @endforeach
    <!--/product-details-->

    <div class="category-tab shop-details-tab">
        <!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
            </ul>
        </div>
        <div class="tab-content" style="padding:10px">
            {!!$pro->moTaSanPham!!}

        </div>
    </div>
    <!--/category-tab-->

    <div class="recommended_items">
        <!--recommended_items-->
        <h2 class="title text-center">Sản phẩm liên quan</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
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
                                    <a href="{{URL::to('/product-details.html/'.$pre_pro->slug)}}"><img
                                            style="width:200px"
                                            src="{{asset('public/upload/products/')}}/{{$pre_pro->hinhAnh}}"
                                            alt="{{$pre_pro->tenSanPham}}" /></a>
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
</div>
@endsection