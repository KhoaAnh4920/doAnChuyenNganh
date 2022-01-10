@extends('frontend.layouts.master',['noDefaultSection' => true],['noslider' => true])
@section('title','Đăng nhập')
@section('content')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Đăng nhập</h2>
                    <form action="{{URL::to('/login-users')}}" method="post">
                       
                        {{ csrf_field() }}
                        <!--Chống injection-->
                        <input type="email" name="user_email" placeholder="Email đăng nhập" />
                        <p class="help is-danger" style="color:red">{{ $errors->first('user_email') }}</p>
                        <input type="password" name="user_password" placeholder="Mật khẩu" />
                        <p class="help is-danger" style="color:red">{{ $errors->first('user_password') }}</p>
                        <a href="{{URL::to('/forgot-password.html')}}">Quên mật khẩu?</a>
   
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Đăng ký tài khoản!</h2>
                    <form action="{{URL::to('/signin-users.html')}}" method="post">
                        {{ csrf_field() }}
                        <!--Chống injection-->
                        <input type="email" name="users_email" placeholder="Email đăng nhập*" require />
                        <p class="help is-danger" style="color:red">{{ $errors->first('users_email') }}</p>
                        <input type="text" name="users_name" placeholder="Tên người dùng*" require />
                        <p class="help is-danger" style="color:red">{{ $errors->first('users_name') }}</p>
                        <input type="password" name="users_password" placeholder="Mật khẩu*" require />
                        <p class="help is-danger" style="color:red">{{ $errors->first('users_password') }}</p>
                        <input type="text" name="users_address" placeholder="Địa chỉ" />
                        <input type="text" name="users_phone" placeholder="Số điện thoại" />
                        <input type="hidden" name="role" value="1" />
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
    

    

</section>
<!--/form-->
@endsection