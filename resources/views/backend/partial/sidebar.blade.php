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
                        <li><a class="active" href="#">Thêm danh mục sản phẩm</a></li>
                        <li><a href="{{URL::to('/liet-ke-danh-muc-san-pham.html')}}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="#" >
                        <i class="fa fa-th"></i>
                        <span>Thương hiệu</span>
                    </a>
                    <ul class="sub">
                        <li><a class="active" href="#">Thêm thương hiệu</a></li>
                        <li><a href="#">Liệt kê thương hiệu</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="#">
                        <i class="fa fa-th"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a class="active" href="#">Thêm sản phẩm</a></li>
                        <li><a href="#">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
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
                        <li><a href="#">Thêm danh mục bài viết</a></li>
                        <li><a href="#">Liệt kê danh mục bài viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="#">
                        <i class="fa fa-tasks"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="#">Thêm bài viết</a></li>
                        <li><a href="#">Liệt kê bài viết</a></li>
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