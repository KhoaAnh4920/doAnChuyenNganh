<div class="left-sidebar">
    <h2>Danh mục sản phẩm</h2>
    <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        Laptop gaming
                    </a>
                </h4>
            </div>
            <div id="sportswear" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <li><a href="{{URL::to('/category-product.html')}}">Acer</a></li>
                        <li><a href="{{URL::to('/category-product.html')}}">Asus</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        Laptop văn phòng
                    </a>
                </h4>
            </div>
            <div id="mens" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <li><a href="{{URL::to('/category-product.html')}}">HP</a></li>
                        <li><a href="{{URL::to('/category-product.html')}}">Dell</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        Điện thoại
                    </a>
                </h4>
            </div>
            <div id="womens" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <li><a href="{{URL::to('/category-product.html')}}">Apple</a></li>
                        <li><a href="{{URL::to('/category-product.html')}}">Samsung</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a href="{{URL::to('/category-product.html')}}">Bàn phím</a></h4>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a href="{{URL::to('/category-product.html')}}">Chuột</a></h4>
            </div>
        </div>
    </div>
    <!--/category-products-->

    <div class="brands_products">
        <!--brands_products-->
        <h2>Thương hiệu</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="{{URL::to('/category-product.html')}}"> <span class="pull-right">(50)</span>Apple</a></li>
                <li><a href="{{URL::to('/category-product.html')}}"> <span class="pull-right">(56)</span>Samsung</a></li>
                <li><a href="{{URL::to('/category-product.html')}}"> <span class="pull-right">(27)</span>Acer</a></li>
            </ul>
        </div>
    </div>
    <!--/brands_products-->

    <div class="shipping text-center">
        <!--shipping-->
        <img src="{{asset('public/frontend/images/home/shipping.jpg')}}" alt="" />
    </div>
    <!--/shipping-->

</div>