<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->
            @foreach($count_danhMucCon as $key => $cate)
            @if($cate->SL > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->maDanhMucCha}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{$cate->tenDanhMuc}}
                            </a>
                        </h4>
                    </div>
                    <div id="{{$cate->maDanhMucCha}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($all_category_products as $key => $cate_sub)
                                @if($cate->maDanhMucCha == $cate_sub->danhMucCha)
                                    <li><a href="{{URL::to('/category-product.html/'.$cate_sub->slug)}}">{{$cate_sub->tenDanhMuc}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{URL::to('/category-product.html/'.$cate->slug)}}">{{$cate->tenDanhMuc}}</a></h4>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
        <!--/category-products-->
        <!--/category-products-->

        <div class="brands_products">
            <!--brands_products-->
            <h2>Thương hiệu</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($all_brands as $key => $brand)
                    <li><a href="{{URL::to('/brands-product.html/'.$brand->slug)}}"> <span
                                class="pull-right">({{$brand->sl}})</span>{{$brand->tenThuongHieu}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--/brands_products-->

        <div class="text-center" style="margin-top:20px">
            <!--shipping-->
            <img src="{{asset('public/frontend/images/Slider/hinh4.jpg')}}" style="width:100%" alt="" />
        </div>
        <!--/shipping-->

    </div>
</div>