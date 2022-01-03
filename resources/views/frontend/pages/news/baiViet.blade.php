@extends('frontend.layouts.master', ['noslider' => true])
@section('title','Bài viết')
@section('advertisement')
<div class="container mb-4">
    <img src="{{asset('public/frontend/images/shop/advertisement.jpg')}}" alt="" />
</div>
<br>
@endsection
@section('defaultContent')
<div class="features_items">
    <h2 style="margin:0;position: inherit;font-size: 20px; color:#000; margin-bottom:10px" class="title">{{$news->tieuDe}}</h2>
    <div class="userdetail">
        <p style="font-size:12px; color: #999; display:inline-block">By</p>
        <p style="color:#288ad6; font-size:12px; font-weight:600; display:inline-block"> {{$news->users_name}}</p>
        <span style="font-size:12px; color: #999;">{{$news->created_at}}</span>
    </div>

    <div class="product-image-wrapper" style="border: none;">

        <div class="single-products" style="margin:10px 0;padding: 2px">
            <div class="row" id="row-detail-1">
                <div class="col-md-12 comboImage" id="detail-img">
                    {!!$news->noiDung!!}
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>

    <!--features_items-->
    <h2 style="margin:0;font-size: 16px" class="title">Xem thêm</h2>
    <style type="text/css">
    ul.post_relate li {
        list-style-type: disc;
        font-size: 16px;
        padding: 6px;
    }

    ul.post_relate li a {
        color: #000;
    }

    ul.post_relate li a:hover {
        color: #FE980F;
    }
    </style>
    <ul class="post_relate">
        @foreach($tinLienQuan as $key => $tin)
            <li><a href="{{URL::to('/chi-tiet-bai-viet.html/'.$tin->slug)}}">{{$tin->tieuDe}}</a></li>
        @endforeach
    </ul>
    @endsection