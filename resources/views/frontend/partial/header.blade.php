<header id="header">
    <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{URL::to('/')}}"><img src="{{asset('public/frontend/images/home/logo.png')}}"
                                alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{URL::to('/checkout.html')}}"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/cart.html')}}"><i class="fa fa-shopping-cart"></i>
                                    @if(Cart::content()->count() != 0)
                                    @php echo "Giỏ hàng(" .Cart::content()->count().")" @endphp
                                    @else
                                    @php echo "Giỏ hàng" @endphp
                                    @endif
                                </a>
                            </li>
                            <?php
                            $users_name = Session::get('user_name');     
                            $users_avatar = Session::get('user_avatar');    
                            if($users_name){
                            ?>
                            <li class="dropdown" style="padding-left: 0px">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <!-- <img style="width:25px; border-radius:50%;" src="public/upload/avatar/<?=$users_avatar?>"> -->
                                    <img style="width:30px; border-radius:50%;"
                                        src="{{asset('public/upload/avatar/')}}/{{$users_avatar}}">
                                    <span class="username"><?=$users_name ?></span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu extended logout" style="padding:10px">
                                    <li><a href="{{URL::to('/logoutUser.html')}}" style="margin-top: 0px"><i
                                                class="fa fa-key"></i>Đăng xuất</a></li>
                                </ul>
                            </li>
                            <?php 
                             }else{
                             ?>
                            <li><a href="{{URL::to('/login.html')}}"><i class="fa fa-lock"></i>Đăng nhập</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{URL::to('/')}}" class="active">Trang chủ</a></li>
                            <li class="dropdown"><a href="#">Apple<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($cate_of_Apple as $key => $pro_apple)
                                    <li><a
                                            href="{{URL::to('/category-product.html/'.$pro_apple->slug)}}">{{$pro_apple->tenDanhMuc}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Gaming gear<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($cate_of_Gear as $key => $pro_gear)
                                    <li><a
                                            href="{{URL::to('/category-product.html/'.$pro_gear->slug)}}">{{$pro_gear->tenDanhMuc}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{URL::to('/danh-muc-bai-viet.html')}}">Trang tin tức</a></li>
                            <li><a href="{{URL::to('/contact.html')}}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>