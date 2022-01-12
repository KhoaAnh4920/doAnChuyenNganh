@extends('frontend.layouts.master',['noDefaultSection' => true],['noslider' => true])
@section('title','Thanh toán')
@section('content')
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title text-center">Liên hệ với chúng tôi</h2>
                <div id="gmap" class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1639.3791647908088!2d106.6773109256197!3d10.737608452217462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBDw7RuZyBOZ2jhu4cgU8OgaSBHw7Ju!5e1!3m2!1svi!2s!4v1635847172571!5m2!1svi!2s"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Để lại lần nhắn</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form action="{{URL::to('/lien-he')}}" id="main-contact-form" class="contact-form row"
                        name="contact-form" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Họ tên">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required"
                                placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" required="required"
                                placeholder="Tiêu đề">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"
                                placeholder="Nội dung"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Thông tin liên hệ</h2>
                    <address>
                        <p>Công ty HKShop</p>
                        <p>Chi nhánh 1: 180 cao lỗ, Phường 4, Quận 8, TP.HCM</p>
                        <p>Chi nhánh 2: 42 Cống Quỳnh, Phường 2, Quận 1, TP.HCM </p>
                        <p>SĐT: 0123456789</p>
                        <p>Email: khoadido@gmail.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Mạng xã hội</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/#contact-page-->
@endsection