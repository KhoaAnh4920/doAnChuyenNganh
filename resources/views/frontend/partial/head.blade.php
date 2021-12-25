<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{csrf_token()}}">
<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

<link rel="shortcut icon" href="{{asset('public/frontend/images/ico/favicon.ico')}}">
<link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="{{asset('public/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="{{asset('public/frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="{{asset('public/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed"
    href="{{asset('public/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
<style>
.thank-you-pop {
    width: 100%;
    padding: 20px;
    text-align: center;
}

.thank-you-pop img {
    width: 76px;
    height: auto;
    margin: 0 auto;
    display: block;
    margin-bottom: 25px;
}

.thank-you-pop h1 {
    font-size: 42px;
    margin-bottom: 25px;
    color: #5C5C5C;
}

.thank-you-pop p {
    font-size: 20px;
    margin-bottom: 27px;
    color: #5C5C5C;
}

.thank-you-pop h3.cupon-pop {
    font-size: 25px;
    margin-bottom: 40px;
    color: #222;
    display: inline-block;
    text-align: center;
    padding: 10px 20px;
    border: 2px dashed #222;
    clear: both;
    font-weight: normal;
}

.thank-you-pop h3.cupon-pop span {
    color: #03A9F4;
}

.thank-you-pop a {
    display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8BC34A;
    border-radius: 17px;
}

.thank-you-pop a i {
    margin-right: 5px;
    color: #fff;
}

#ignismyModal .modal-header {
    border: 0px;
}

/*--thank you pop ends here--*/
</style>