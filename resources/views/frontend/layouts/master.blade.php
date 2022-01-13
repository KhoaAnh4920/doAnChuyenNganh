<!DOCTYPE html>
<html lang="en">


<head>
    <title>@yield('title')</title>
    @include("frontend.partial.head")
    <!--Gọi thêm thư viện css-->
    @yield('style-libraries')
    <!--Custom css-->
    @yield('styles')
</head>

<body>
    <!--header-->
    @include("frontend.partial.header")
    <!--/header-->


    <section>
        <!--advertisement-->
        @yield('advertisement')
        <!--End advertisement-->
    </section>


    @unless(isset($noslider)) <!-- Bẩy silder --> 
    <!--slider-->
    @include("frontend.partial.slider")
    <!--/slider-->
    @endunless


    @yield('content')

    @unless(isset($noDefaultSection))
    <section>
        <div class="container">
            <div class="row">
                @unless(isset($noslidebar))
                    @include("frontend.partial.slidebar")
                @endunless
                @yield('defaultContent')

            </div>
        </div>
    </section>
    @endunless

    

    <!--Model Thông Báo-->
    @include('sweet::alert')

    

    <!--Footer-->
    @include("frontend.partial.footer")
    <!--/Footer-->


    <!--Script-->
    @include("frontend.partial.script")
    <!--End Script-->
</body>

</html>