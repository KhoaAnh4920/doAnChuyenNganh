<section id="slider">
<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<!-- <ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol> -->
						
						<div class="carousel-inner row">
							@php $i= 1 @endphp
							@foreach($all_slider as $key => $slide)

							<div class="item {{($i == 1) ? 'active' : ''}} col-sm-12">
								<img src="{{asset('public/upload/slider/')}}/{{$slide->hinhAnh}}" style="width:100%" class="img-fluid" alt="" />
							</div>
							@php $i++ @endphp
							@endforeach
	
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
</section>