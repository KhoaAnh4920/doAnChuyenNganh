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

.leftcate {
    float: left;
    overflow: hidden;
    width: 65.834%;
}

.rightcate {
    float: right;
    overflow: visible;
    width: 31.667%;
}
.latest {
    display: block;
    overflow: hidden;
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
    margin-top: -10px;
}

.newslist {
    display: block;
    overflow: hidden;
}
ul, ol {
    list-style: none;
}
.newslist {
    display: block;
    overflow: hidden;
}
.latest li:first-child {
    overflow: hidden;
    width: 65.19%;
    margin-right: 15px;
    border-bottom: 0;
}


.latest li {
    overflow: hidden;
    float: left;
    width: 32%;
    padding: 0;
}

.newslist li {
    display: block;
    overflow: hidden;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
    position: relative;
}
.latest li:last-child {
    border-bottom: 0;
}
.newslist li h3.titlecom {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    overflow: hidden;
}

.latest li h3 {
    font-size: 15px;
    line-height: 1.3em;
    font-weight: 300;
    margin-bottom: 0;
}
.userdetail span:before {
    content: '•';
    display: inline-block;
    vertical-align: middle;
    margin-right: 8px;
    font-size: 18px;
    color: #ccc;
}

</style>