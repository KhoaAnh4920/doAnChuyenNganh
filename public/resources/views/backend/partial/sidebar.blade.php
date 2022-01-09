<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{URL::to('/admin')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('public/backend/img/logo/logo2.png')}}">
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
            aria-controls="collapseForm">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Forms</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Forms</h6>
                <a class="collapse-item" href="form_basics.html">Form Basics</a>
                <a class="collapse-item" href="form_advanceds.html">Form Advanceds</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
            aria-controls="collapseTable">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableUser"
            aria-expanded="true" aria-controls="collapseTableUser">
            <i class="fa fa-user"></i>
            <span>Quản lý người dùng</span>
        </a>
        <div id="collapseTableUser" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="{{URL::to('/liet-ke-user.html')}}">Xem DS user</a>
                <a class="collapse-item" href="{{URL::to('/them-user.html')}}">Thêm user</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableCategoryProduct"
            aria-expanded="true" aria-controls="collapseTableCategoryProduct">
            <i class="fa fa-th"></i>
            <span>Danh mục sản phẩm</span>
        </a>
        <div id="collapseTableCategoryProduct" class="collapse" aria-labelledby="headingTable"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="{{URL::to('/liet-ke-danh-muc-san-pham.html')}}">Xem danh mục sản phẩm</a>
                <a class="collapse-item" href="{{URL::to('/them-danh-muc-san-pham.html')}}">Thêm danh mục sản phẩm</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableBrand"
            aria-expanded="true" aria-controls="collapseTableBrand">
            <i class="fa fa-th"></i>
            <span>Thương hiệu</span>
        </a>
        <div id="collapseTableBrand" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="{{URL::to('/liet-ke-thuong-hieu.html')}}">Xem DS thương hiệu</a>
                <a class="collapse-item" href="{{URL::to('/them-thuong-hieu.html')}}">Thêm thương hiệu</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableProduct"
            aria-expanded="true" aria-controls="collapseTableProduct">
            <i class="fa fa-th"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="collapseTableProduct" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="{{URL::to('/liet-ke-san-pham.html')}}">Xem DS sản phẩm</a>
                <a class="collapse-item" href="{{URL::to('/them-san-pham.html')}}">Thêm sản phẩm</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableOrder"
            aria-expanded="true" aria-controls="collapseTableOrder">
            <i class="fa fa-th"></i>
            <span>Đơn hàng</span>
        </a>
        <div id="collapseTableOrder" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="{{URL::to('/liet-ke-don-hang.html')}}">Liệt kê đơn hàng</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableSlider"
            aria-expanded="true" aria-controls="collapseTableSlider">
            <i class="fa fa-th"></i>
            <span>Slider</span>
        </a>
        <div id="collapseTableSlider" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="{{URL::to('/liet-ke-slider.html')}}">Liệt kê slider</a>
                <a class="collapse-item" href="{{URL::to('/them-slider.html')}}">Thêm slider</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableCategoryPost"
            aria-expanded="true" aria-controls="collapseTableCategoryPost">
            <i class="fa fa-th"></i>
            <span>Danh mục bài viết</span>
        </a>
        <div id="collapseTableCategoryPost" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="{{URL::to('/liet-ke-danh-muc-bai-viet.html')}}">Danh mục bài viết</a>
                <a class="collapse-item" href="{{URL::to('/them-danh-muc-bai-viet.html')}}">Thêm danh mục bài viết</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTablePost"
            aria-expanded="true" aria-controls="collapseTablePost">
            <i class="fa fa-th"></i>
            <span>Bài viết</span>
        </a>
        <div id="collapseTablePost" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="{{URL::to('/liet-ke-bai-viet.html')}}">Liệt kê bài viết</a>
                <a class="collapse-item" href="{{URL::to('/them-bai-viet.html')}}">Thêm bài viết</a>
            </div>
        </div>
    </li>


    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>