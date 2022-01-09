@extends('frontend.layouts.master', ['noslider' => true], ['noslidebar' => true])
@section('title','Danh mục bài viết')
@section('advertisement')

@section('defaultContent')
@php
use Carbon\Carbon;
Carbon::setLocale('vi');
@endphp
<div class="features_items">

    <div class="col-sm-12" style="padding-top: 10px;background: #fafafa;margin-bottom: 10px;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="mainmenu pull-left">
            <ul class="nav navbar-nav collapse navbar-collapse">
                <li><a href="{{URL::to('/danh-muc-bai-viet.html/tin-moi-nhat')}}" @php if($slug=='tin-moi-nhat' )
                        echo "class='active'" @endphp style="font-size:15px">Mới nhất</a></li>
                @foreach($cate_news as $key =>$cate)
                <li><a href="{{URL::to('/danh-muc-bai-viet.html/'.$cate->slug)}}" @php if($slug==$cate->slug) echo
                        "class='active'" @endphp style="font-size:15px">{{$cate->tenDanhMuc}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <aside class="leftcate">

        <ul class="newslist latest" style="padding-left: 15px; margin-top:10px">
            <div class="infopage" style="margin-bottom:20px">
                <h4 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-right: 15px;">Tin mới nhất</h4>
            </div>
            <div class="col-sm-7" style="padding-left:0">

                @php $lastId = 0; @endphp
                @foreach($tintuc as $key =>$tin)

                <li rel="left-one" style="width: 100%;">
                    <a href="{{URL::to('/chi-tiet-bai-viet.html/'.$tin->slug)}}">
                        <div class="tempvideo">
                            <img src="{{asset('public/upload/news/')}}/{{$tin->hinhAnh}}"
                                style="width: 100%;height: 100%; margin-bottom:5px">
                        </div>
                        <a href="{{URL::to('/chi-tiet-bai-viet.html/'.$tin->slug)}}"
                            style="font-size:18px; text-decoration:none; color:#000; margin-bottom:5px">{{$tin->tieuDe}}</a>
                        <!-- <h3 class="titlecom">
                                {{$tin->tieuDe}}
                            </h3> -->
                        <figure>
                            {!!$tin->moTa!!}
                        </figure>
                        <div class="timepost margin">
                            @php
                            $dt= \Carbon\Carbon::parse($tin->created_at);
                            $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
                            @endphp
                            <span style="font-size:12px; font-style: italic;">{{ $dt->diffForHumans($now) }} </span>
                        </div>
                    </a>
                </li>
                @php $lastId = $tin->maBaiViet; @endphp
                @break
                @endforeach
            </div>
            <!-- Load tin bên phải -->
            @php $dem = 1 @endphp
            <div class="col-sm-5">
                @foreach($tintuc as $key =>$tin)
                    @if($tin->maBaiViet < $lastId) 
                        @if($dem == 1)
                            <li rel="right-one" style="width: 100%; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                                <a href="{{URL::to('/chi-tiet-bai-viet.html/'.$tin->slug)}}">
                                    <div class="tempvideo">
                                        <img src="{{asset('public/upload/news/')}}/{{$tin->hinhAnh}}"
                                            style="width: 100%;height: 100%;  margin-bottom:5px">
                                    </div>
                                    <a href="{{URL::to('/chi-tiet-bai-viet.html/'.$tin->slug)}}"
                                        style="font-size:16px; text-decoration:none; color:#000; margin-bottom:5px">{{$tin->tieuDe}}</a>
                                    <div class="timepost margin">
                                        @php
                                        $dt= \Carbon\Carbon::parse($tin->created_at);
                                        $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
                                        @endphp
                                        <span style="font-size:12px; font-style: italic;">{{ $dt->diffForHumans($now) }} </span>
                                    </div>
                                </a>
                            </li>
                        @else
                            <li rel="top3-list" style="width: 100%; margin-top:10px; ">
                                <a href="{{URL::to('/chi-tiet-bai-viet.html/'.$tin->slug)}}"
                                    style="font-size:14px; text-decoration:none; color:#000; margin-bottom:5px">{{$tin->tieuDe}}</a>
                            </li>
                        @endif
                        @php $dem++ @endphp
                        @if($dem == 4)
                            @php $lastId = $tin->maBaiViet; @endphp
                            @break
                        @endif
                    @endif
                @endforeach

                
            </div>


        </ul>

        <ul class="newslist" id="mainlist">


            <!-- @foreach($tintuc as $key =>$tin)
                @if($tin->maBaiViet < $lastId)
                    <li data-id="{{$tin->maBaiViet}}"  style="padding-bottom: 10px;">
                        <div class="single-products" style="margin:10px 0;">
                            <img style="float:left;width:30%;padding: 5px;height: 100%; margin-right: 5px;"
                                src="{{asset('public/upload/news/')}}/{{$tin->hinhAnh}}" alt="" />

                            <h4 style="padding: 5px;"><a href="{{URL::to('/chi-tiet-bai-viet.html')}}"
                                    style="color:#000000;">{{$tin->tieuDe}}</a> </h4>
                            <p style="font-size:13px">{{$tin->created_at}}</p>
                        </div>
                    </li>
                    @php $lastId = $tin->maBaiViet; @endphp
                @endif
            @endforeach -->



        </ul>
    </aside>
    <!-- Load tin khuyến mãi  -->
    <aside class="rightcate">
        <ul class="newspromotion" style="padding-left:0">
            <div class="infopage" style="margin-bottom:20px; margin-top:20px">
                <h4 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-right: 15px;">Tin khuyến mãi</h4>
            </div>
            @foreach($khuyenMai as $key =>$km)
                <li rel="right-one" style="width: 100%; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom:20px">
                    <a href="{{URL::to('/chi-tiet-bai-viet.html/'.$km->slug)}}">
                        <div class="tempvideo">
                            <img src="{{asset('public/upload/news/')}}/{{$km->hinhAnh}}"
                                style="width: 100%;height: 100%;  margin-bottom:5px">
                        </div>
                        <a href="{{URL::to('/chi-tiet-bai-viet.html/'.$km->slug)}}"
                            style="font-size:16px; text-decoration:none; color:#000; margin-bottom:5px">{{$km->tieuDe}}</a>
                    </a>
                </li>
            @endforeach

        </ul>
        <div class="clr"></div>
    </aside>
    </aside>

</div>

@endsection