@extends('frontend.layouts.master',['noDefaultSection' => true],['noslider' => true])
@section('title','Quên mật khẩu')
@section('content')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div  class="col-sm-2 col-sm-offset-1"></div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="login-form">
                    <!--forgot pass form-->
                    <h2>Quên mật khẩu</h2>
                    <form action="{{URL::to('/recover-pass')}}" method="post">
                        {{ csrf_field() }}
                        <!--Chống injection-->
                        <input type="email" name="users_email" placeholder="Nhập email" />
   
                        <button type="submit" class="btn btn-default">Tiếp theo</button>
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