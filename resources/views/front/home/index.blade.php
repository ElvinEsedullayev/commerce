@extends('front.layouts.master')
@section('content')
	<div class="span9">
				<div class="well well-small">
					<h4>Featured Products <small class="pull-right">{{$featuredItemCount}}+ featured products</small></h4>
					<div class="row-fluid">
						<div id="featured" @if($featuredItemCount > 4) class="carousel slide" @endif>
							<div class="carousel-inner">
							@foreach($productItemChuck as $key => $featuredItem)
								<div class="item @if($key ==1) active @endif">
									<ul class="thumbnails">
									@foreach($featuredItem as $item)
										<li class="span3">
											<div class="thumbnail">
												<i class="tag"></i>
												<a href="product_details.html">
													@php
															$product_image_path = 'front/images/products/small/'.$item['product_image'];
													@endphp
													@if(!empty($item['product_image']) && file_exists($product_image_path))
													<img src="{{url('front/images/products/small/'.$item['product_image'])}}" alt="">
													@else 
													<img src="{{url('front/images/products/no-image.png')}}" alt="">
													@endif
												</a>
												<div class="caption">
													<h5>{{$item['product_name']}}</h5>
													<h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.{{$item['product_price']}}</span></h4>
												</div>
											</div>
										</li>
									@endforeach
									</ul>
								</div>
							@endforeach
							
							</div>
							{{-- <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
							<a class="right carousel-control" href="#featured" data-slide="next">›</a> --}}
						</div>
					</div>
				</div>
				<h4>Latest Products </h4>
				<ul class="thumbnails">
					@foreach($newProducts as $product)
					<li class="span3">
						<div class="thumbnail">
							<a  href="product_details.html">
								@php
										$product_image_path = 'front/images/products/small/'.$product['product_image'];
								@endphp
								@if(!empty($product['product_image']) && file_exists($product_image_path))
								<img width="160" src="{{url('front/images/products/small/'.$product['product_image'])}}" alt=""/>
								@else 
								<img width="160" src="{{url('front/images/products/small/no-image.png')}}" alt=""/>
								@endif
							</a>
							<div class="caption">
								<h5>{{$product['product_name']}}</h5>
								<p>
									{{$product['product_code']}} {{$product['product_color']}}
								</p>
								
								<h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$.{{$product['product_price']}}</a></h4>
							</div>
						</div>
					</li>
				@endforeach
				</ul>
			</div>
@endsection      