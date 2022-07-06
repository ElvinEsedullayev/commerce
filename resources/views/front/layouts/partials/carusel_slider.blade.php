@php
use App\Models\Banner;
$banners = Banner::banners();		
@endphp
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		@foreach($banners as $key => $banner)
			<div class="item @if($key == 0) active @endif">
				<div class="container">
					<a @if(!empty($banner['link'])) href="{{url($banner['link'])}}" @else href="Javascript:void(0)" @endif><img style="width:100%" src="{{url('front/images/banners/'.$banner['banner_image'])}}" alt="{{$banner['alt']}}" title="{{$banner['title']}}"/></a>
					<div class="carousel-caption">
						<h4>First Thumbnail label</h4>
						<p>Banner text</p>
					</div>
				</div>
			</div>
			@endforeach
		
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>