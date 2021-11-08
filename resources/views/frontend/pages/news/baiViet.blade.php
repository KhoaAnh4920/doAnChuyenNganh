@extends('frontend.layouts.master')
@section('title','Bài viết')
@section('defaultContent')
<div class="features_items">
    <h2 style="margin:0;position: inherit;font-size: 22px" class="title text-center">Tiêu đề bài viết</h2>

    <div class="product-image-wrapper" style="border: none;">

        <div class="single-products" style="margin:10px 0;padding: 2px">
            <div class="row" id="row-detail-1">
                <div class="col-md-12 comboImage" id="detail-img">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio illum in nam ipsum quos
                        culpa! Voluptatum, in! Sequi ad dolore esse itaque ullam nisi, minima cum impedit blanditiis
                        doloremque vel.
                        Quisquam reiciendis provident fugiat libero quibusdam iste hic sequi nobis esse odit, dolorem
                        veniam sint officiis velit tempore eaque accusamus ad dolorum? Explicabo asperiores, mollitia
                        ducimus esse at dolorum ab?</p>
                    <img src="{{asset('public/frontend/images/shop/product12.jpg')}}" alt="#"
                        style="display:block; margin-left:auto; margin-right:auto; padding-bottom: 10px">
                    <div class="captionImg" style="font-size:14px; text-align:center; margin-bottom:15px">Hình ảnh 1
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta excepturi asperiores nisi esse
                        consequuntur vel fuga reiciendis accusamus illum eos libero error est unde ad aut, culpa non
                        eveniet. Laborum.
                        Ipsa dolor, sit dicta officiis molestiae, doloribus a dolores maiores quis perspiciatis
                        voluptatum ex nesciunt ea repellat nulla exercitationem adipisci quae doloremque labore dolorem
                        eum. Nisi et deleniti dignissimos sint!
                        Soluta atque illum, iste dolorem voluptatum assumenda ullam mollitia repellendus quaerat
                        dignissimos quidem explicabo unde, voluptate magni delectus veniam voluptas totam eos nobis
                        impedit est. Earum, nisi quidem? Ab, libero.
                        Repudiandae quaerat sint magnam pariatur qui dolorum accusantium, totam assumenda inventore
                        minus libero perferendis excepturi iure dolores ad eum! Facilis doloremque placeat optio
                        quisquam aliquid reprehenderit accusantium eligendi iusto omnis?
                        A architecto atque adipisci animi sed voluptatibus incidunt nemo, omnis, inventore nisi quo vero
                        natus voluptatem iure illum eveniet nesciunt repellendus maxime repellat rerum earum! Nesciunt
                        ut reiciendis molestias ipsa?</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta excepturi asperiores nisi esse
                        consequuntur vel fuga reiciendis accusamus illum eos libero error est unde ad aut, culpa non
                        eveniet. Laborum.
                        Ipsa dolor, sit dicta officiis molestiae, doloribus a dolores maiores quis perspiciatis
                        voluptatum ex nesciunt ea repellat nulla exercitationem adipisci quae doloremque labore dolorem
                        eum. Nisi et deleniti dignissimos sint!
                        Soluta atque illum, iste dolorem voluptatum assumenda ullam mollitia repellendus quaerat
                        dignissimos quidem explicabo unde, voluptate magni delectus veniam voluptas totam eos nobis
                        impedit est. Earum, nisi quidem? Ab, libero.</p>
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
        <li><a href="#">Bài viết 1</a></li>
        <li><a href="#">Bài viết 2</a></li>
        <li><a href="#">Bài viết 3</a></li>
    </ul>
    @endsection