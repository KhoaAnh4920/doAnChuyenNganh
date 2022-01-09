<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link href="{{asset('public/backend/img/logo/logo.png')}}" rel="icon">
<title>RuangAdmin - Dashboard</title>
<link href="{{asset('public/backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/backend/css/ruang-admin.min.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{csrf_token()}}">

<!-- font CSS -->
<link
    href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
    rel='stylesheet' type='text/css'>


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

#preview img {
    width: 100px;
    margin-top: 5px;
}

.thumbnail {
    width: 120px;
    position: relative;
    float: left;
    margin: 1em;
}

.thumbnail img {
    max-width: 100%;
    max-height: 100%;
    padding: 10px;
}

.thumbnail a {
    display: block;
    width: 15px;
    height: 15px;
    position: absolute;
    top: 3px;
    right: 3px;
    background: #c00;
    overflow: hidden;
    text-indent: -9999px;
}


/*--thank you pop ends here--*/

input[type="file"] {
    display: block;
}

.imageThumb {
    max-height: 75px;
    border: 2px solid;
    padding: 1px;
    cursor: pointer;
}

.pip {
    display: inline-block;
    margin: 10px 10px 0 0;
}

.remove,
.removeDefault {
    display: block;
    background: #444;
    border: 1px solid black;
    color: white;
    text-align: center;
    cursor: pointer;
}

.remove:hover {
    background: white;
    color: black;
}
</style>