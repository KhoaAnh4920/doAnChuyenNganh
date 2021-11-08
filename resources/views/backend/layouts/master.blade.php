<!DOCTYPE html>
<head>
<title>@yield('title')</title>
@include('backend.partial.head')
</head>
<body>
<section id="container">
<!--header start-->
@include("backend.partial.header");
<!--header end-->
<!--sidebar start-->
@include("backend.partial.sidebar");
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    @yield('content')
 <!-- footer -->
		  @include("backend.partial.footer");
  <!-- / footer -->
</section>

<!--main content end-->
</section>

<!--Start script-->
@include('backend.partial.script');
<!--End script-->
</body>
</html>
