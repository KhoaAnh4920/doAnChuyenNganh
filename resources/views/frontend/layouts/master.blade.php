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
				<div class="col-sm-3">
                @include("frontend.partial.slidebar")
				</div>
				
				<div class="col-sm-9 padding-right">
					@yield('defaultContent')			
				</div>
			</div>
		</div>
	</section>
	@endunless
	
	<!--Footer-->
        @include("frontend.partial.footer")
	<!--/Footer-->
	

    <!--Script-->
        @include("frontend.partial.script")
    <!--End Script-->
</body>
</html>