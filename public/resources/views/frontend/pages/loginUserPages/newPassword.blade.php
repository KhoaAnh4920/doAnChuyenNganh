@extends('frontend.layouts.master',['noDefaultSection' => true],['noslider' => true])
@section('title','Reset password')
@section('content')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div  class="col-sm-2 col-sm-offset-1"></div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="login-form">
                    <!--forgot pass form-->
                    <h2>Nhập mật khẩu mới</h2>
                    <form action="{{URL::to('/update-pass-handle')}}" method="POST">
                        {{ csrf_field() }}
                        <!--Chống injection-->
                        <input type="hidden" value="{{$email}}" name="email">
                        <input type="hidden" value="{{$token}}" name="token">
                        <input type="password" name="users_password" placeholder="Nhập mật khẩu mới" />
                        <input type="password" name="users_RePassword" placeholder="Nhập lại mật khẩu" />
   
                        <button type="submit" class="btn btn-default">Đổi mật khẩu</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div  class="col-sm-2 col-sm-offset-1"></div>
        </div>
    </div>
    
</section>
<!--/form-->
@endsection