@extends('frontend.layouts.master', ['noslider' => true])
@section('title','Danh mục bài viết')
@section('advertisement')
<div class="container mb-4">
    <img src="{{asset('public/frontend/images/shop/advertisement.jpg')}}" alt="" />
</div>
<br>
@endsection
@section('defaultContent')
<div class="features_items">

    <h2 class="title text-center">Tin công nghệ mới nhất</h2>

    <div class="product-image-wrapper" style="border: none;">

        <div class="single-products" style="margin:10px 0;padding: 2px">
            <img style="float:left;width:30%;padding: 5px;height: 150px"
                src="{{asset('public/frontend/images/shop/product12.jpg')}}" alt="" />

            <h4 style="padding: 5px;"><a href="{{URL::to('/chi-tiet-bai-viet.html')}}" style="color:#000000;">Bài viết 1</a> </h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus ab consequatur reiciendis, et nisi qui
                distinctio eius possimus veniam tempora quos saepe iusto repudiandae quis facilis provident! Quis,
                debitis possimus!
                Quasi fugit delectus deleniti aut eos asperiores nam debitis cum non vel quidem provident, dolore
                exercitationem ut ex doloribus aspernatur amet? Magnam, quis? Quam error temporibus, accusamus
                beatae nisi nulla?</p>
            <div class="text-right">
                <a href="{{URL::to('/chi-tiet-bai-viet.html')}}" class="btn btn-default btn-sm">Xem bài viết</a>
            </div>
        </div>
        <div class="single-products" style="margin:10px 0;padding: 2px">
            <img style="float:left;width:30%;padding: 5px;height: 150px"
                src="{{asset('public/frontend/images/shop/product12.jpg')}}" alt="" />

            <h4 style="padding: 5px;"><a href="{{URL::to('/chi-tiet-bai-viet.html')}}" style="color:#000000;">Bài viết 2</a> </h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus ab consequatur reiciendis, et nisi qui
                distinctio eius possimus veniam tempora quos saepe iusto repudiandae quis facilis provident! Quis,
                debitis possimus!
                Quasi fugit delectus deleniti aut eos asperiores nam debitis cum non vel quidem provident, dolore
                exercitationem ut ex doloribus aspernatur amet? Magnam, quis? Quam error temporibus, accusamus
                beatae nisi nulla?</p>
            <div class="text-right">
                <a href="{{URL::to('/chi-tiet-bai-viet.html')}}" class="btn btn-default btn-sm">Xem bài viết</a>
            </div>
        </div>
        <div class="single-products" style="margin:10px 0;padding: 2px">
            <img style="float:left;width:30%;padding: 5px;height: 150px"
                src="{{asset('public/frontend/images/shop/product12.jpg')}}" alt="" />

            <h4 style="padding: 5px;"><a href="{{URL::to('/chi-tiet-bai-viet.html')}}" style="color:#000000;">Bài viết 3</a> </h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus ab consequatur reiciendis, et nisi qui
                distinctio eius possimus veniam tempora quos saepe iusto repudiandae quis facilis provident! Quis,
                debitis possimus!
                Quasi fugit delectus deleniti aut eos asperiores nam debitis cum non vel quidem provident, dolore
                exercitationem ut ex doloribus aspernatur amet? Magnam, quis? Quam error temporibus, accusamus
                beatae nisi nulla?</p>
            <div class="text-right">
                <a href="{{URL::to('/chi-tiet-bai-viet.html')}}" class="btn btn-default btn-sm">Xem bài viết</a>
            </div>
        </div>
        <div class="single-products" style="margin:10px 0;padding: 2px">
            <img style="float:left;width:30%;padding: 5px;height: 150px"
                src="{{asset('public/frontend/images/shop/product12.jpg')}}" alt="" />

            <h4 style="padding: 5px;"><a href="{{URL::to('/chi-tiet-bai-viet.html')}}" style="color:#000000;">Bài viết 4</a> </h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus ab consequatur reiciendis, et nisi qui
                distinctio eius possimus veniam tempora quos saepe iusto repudiandae quis facilis provident! Quis,
                debitis possimus!
                Quasi fugit delectus deleniti aut eos asperiores nam debitis cum non vel quidem provident, dolore
                exercitationem ut ex doloribus aspernatur amet? Magnam, quis? Quam error temporibus, accusamus
                beatae nisi nulla?</p>
            <div class="text-right">
                <a href="{{URL::to('/chi-tiet-bai-viet.html')}}" class="btn btn-default btn-sm">Xem bài viết</a>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>

</div>

@endsection