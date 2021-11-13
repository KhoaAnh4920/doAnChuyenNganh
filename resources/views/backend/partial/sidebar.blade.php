<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li class="sub-menu">
                    <a class="active" href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Quản lý người dùng</span>
                    </a>
                    <ul class="sub">
                        <li><a class="active" href="{{URL::to('/them-user.html')}}">Thêm user</a></li>
                        <li><a href="{{URL::to('/liet-ke-user.html')}}">Liệt kê user</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="#" >
                        <i class="fa fa-th"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a class="active" href="{{URL::to('/them-danh-muc-san-pham.html')}}">Thêm danh mục sản phẩm</a></li>
                        <li><a href="{{URL::to('/liet-ke-danh-muc-san-pham.html')}}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="#" >
                        <i class="fa fa-th"></i>
                        <span>Thương hiệu</span>
                    </a>
                    <ul class="sub">
                        <li><a class="active" href="{{URL::to('/them-thuong-hieu.html')}}">Thêm thương hiệu</a></li>
                        <li><a href="{{URL::to('/liet-ke-thuong-hieu.html')}}">Liệt kê thương hiệu</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="#">
                        <i class="fa fa-th"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a class="active" href="{{URL::to('/them-san-pham.html')}}">Thêm sản phẩm</a></li>
                        <li><a href="{{URL::to('/liet-ke-san-pham.html')}}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{URL::to('/liet-ke-don-hang.html')}}">
                        <i class="fa fa-th"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-tasks"></i>
                        <span>Quản lý danh mục bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/them-danh-muc-bai-viet.html')}}">Thêm danh mục bài viết</a></li>
                        <li><a href="{{URL::to('/liet-ke-danh-muc-bai-viet.html')}}">Liệt kê danh mục bài viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-tasks"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/them-bai-viet.html')}}">Thêm bài viết</a></li>
                        <li><a href="{{URL::to('/tat-ca-bai-viet.html')}}">Liệt kê bài viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-tasks"></i>
                        <span>Danh mục hình ảnh</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/them-danh-muc-hinh.html')}}">Thêm danh mục hình ảnh</a></li>
                        <li><a href="{{URL::to('/liet-ke-danh-muc-hinh.html')}}">Liệt kê danh mục hình</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{URL::to('/admin-login.html')}}">
                        <i class="fa fa-user"></i>
                        <span>Trang login</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>