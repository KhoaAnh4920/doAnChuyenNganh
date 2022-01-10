@extends('backend.layouts.master')
@section('title','Sửa thông tin user')
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin người dùng</h6>
                </div>
                <div class="card-body">
                    @foreach($edit_users as $key => $user)
                    <form role="form" action="{{URL::to('/update-users.html/'.$user->users_id)}}" method="post"
                        enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" class="form-control" name="users_id" readonly
                                value="{{$user->users_id}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" readonly name="users_email" value="{{$user->users_email}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername">Username</label>
                            <input type="text" class="form-control" name="users_name" value="{{$user->users_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="text" class="form-control" name="users_password"
                                value="{{$user->users_password}}" readonly placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone">Số điện thoại</label>
                            <input type="text" class="form-control" name="users_phone" value="{{$user->users_phone}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone">Địa chỉ</label>
                            <input type="text" class="form-control" name="users_address" value="{{$user->users_address}}">
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role">
                                <option value="1" <?php if($user->users_role == 1) echo "selected"; ?>>User</option>
                                <option value="2" <?php if($user->users_role == 2) echo "selected"; ?>>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Avatar</label>
                            <div class="custom-file">
                                

                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="customFile" name="user_avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img id="blah" style="width:80px;height:80px;  margin-top:5px;"
                                    src="../public/upload/avatar/{{$user->users_avatar}}">
                            </div>
                        
                        </div>
                        <!-- <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div> -->
                        <button type="submit" class="btn btn-primary" style="margin-top:30px">Cập nhật</button>
                    </form>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="col-lg-2"></div>


    </div>

</div>
<!---Container Fluid-->
@endsection