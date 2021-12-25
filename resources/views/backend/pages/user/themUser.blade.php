@extends('backend.layouts.master')
@section('title','Trang Admin')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Basics</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm người dùng</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm người dùng</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="{{URL::to('/create-users.html')}}" method="post"
                        enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="users_email" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername">Username</label>
                            <input type="text" class="form-control" name="users_name" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="text" class="form-control" name="users_password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone">Số điện thoại</label>
                            <input type="text" class="form-control" name="users_phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role">
                                <option value="1" selected>User</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="customFile" name="user_avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img id="blah" style="width:80px;height:80px;  margin-top:5px;"
                                    src="http://www.ncenet.com/wp-content/uploads/2020/04/no-image-png-2.png">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:30px">Submit</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-3"></div>

    </div>

</div>
<!---Container Fluid-->
@endsection