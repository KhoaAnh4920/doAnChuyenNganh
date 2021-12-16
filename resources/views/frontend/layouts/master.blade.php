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


    @unless(isset($noslider))
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

    @if(empty(Session::get('message')))
    	@php $message = ""; @endphp
    @endif

	@if(!empty(Session::get('message')))
    	@php $message = Session::get('message');; @endphp
    @endif

    <!--Model Popup starts-->
    <div class="container">
        <div class="row">
            <div class="modal fade" id="ignismyModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label=""><span>×</span></button>
                        </div>

                        <div class="modal-body">
                            <div class="thank-you-pop">
                                <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png"
                                    alt="">
                                <p>{{$message}}</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Model Popup ends-->



    <!--Footer-->
    @include("frontend.partial.footer")
    <!--/Footer-->


    <!--Script-->
    @include("frontend.partial.script")
    <!--End Script-->
</body>

</html>