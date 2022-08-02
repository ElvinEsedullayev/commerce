@extends('front.layouts.master')
@section('content')
<div class="span9">
			<ul class="breadcrumb">
				<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
				<li><a href="{{url('/'.$productDetail['category']['url'])}}">{{$productDetail['category']['category_name']}}</a> <span class="divider">/</span></li>
				<li class="active">{{$productDetail['product_name']}}</li>
			</ul>
			<div class="row">
				<div id="gallery" class="span3">
					<a href="{{asset('front/images/products/medium/'.$productDetail['product_image'])}}" title="Blue Casual T-Shirt">
						<img src="{{asset('front/images/products/large/'.$productDetail['product_image'])}}" style="width:100%" alt="Blue Casual T-Shirt"/>
					</a>
					<div id="differentview" class="moreOptopm carousel slide">
						<div class="carousel-inner">
							<div class="item active">
								@foreach($productDetail['images'] as $image)
								<a href="{{asset('front/images/products/large/'.$image['image'])}}"> <img style="width:29%" src="{{asset('front/images/products/large/'.$image['image'])}}" alt=""/></a>
								@endforeach
							
							</div>
						
						</div>
						<!--
									<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
						-->
					</div>
					
					<div class="btn-toolbar">
						<div class="btn-group">
							<span class="btn"><i class="icon-envelope"></i></span>
							<span class="btn" ><i class="icon-print"></i></span>
							<span class="btn" ><i class="icon-zoom-in"></i></span>
							<span class="btn" ><i class="icon-star"></i></span>
							<span class="btn" ><i class=" icon-thumbs-up"></i></span>
							<span class="btn" ><i class="icon-thumbs-down"></i></span>
						</div>
					</div>
				</div>
				<div class="span6">
					<h3>{{$productDetail['product_name']}}  </h3>
					<small>- {{$productDetail['brand']['name']}}</small>
					<hr class="soft"/>
					<small>{{$total_stock}} items in stock</small>
					<form class="form-horizontal qtyFrm">
						<div class="control-group">
							<h4 class="getAttrPrice">Rs.{{$productDetail['product_price']}}</h4>
								<select name="size" id="getPrice" product-id="{{$productDetail['id']}}" class="span2 pull-left">
									<option value="">Select Size</option>
									@foreach($productDetail['attributes'] as $attr)
									<option value="{{$attr['size']}}">{{$attr['size']}}</option>
									@endforeach
								</select>
								<input type="number" class="span1" placeholder="Qty."/>
								<button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
							</div>
						</div>
					</form>
				
					<hr class="soft clr"/>
					<p class="span6">
						{{$productDetail['description']}}
						
					</p>
					<a class="btn btn-small pull-right" href="#detail">More Details</a>
					<br class="clr"/>
					<a href="#" name="detail"></a>
					<hr class="soft"/>
				</div>
				
				<div class="span9">
					<ul id="productDetail" class="nav nav-tabs">
						<li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
						<li><a href="#profile" data-toggle="tab">Related Products</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="home">
							<h4>Product Information</h4>
							<table class="table table-bordered">
								<tbody>
									<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
									<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{$productDetail['brand']['name']}}</td></tr>
									<tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{$productDetail['product_code']}}</td></tr>
									<tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{$productDetail['product_color']}}</td></tr>
									@if(!empty($productDetail['fabric']))
									<tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{$productDetail['fabric']}}</td></tr>
									@endif
									@if(!empty($productDetail['pattern']))
									<tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{$productDetail['pattern']}}</td></tr>
									@endif
									@if(!empty($productDetail['sleeve']))
									<tr class="techSpecRow"><td class="techSpecTD1">Sleeve:</td><td class="techSpecTD2">{{$productDetail['sleeve']}}</td></tr>
									@endif
									@if(!empty($productDetail['fit']))
									<tr class="techSpecRow"><td class="techSpecTD1">Fit:</td><td class="techSpecTD2">{{$productDetail['fit']}}</td></tr>
									@endif
									@if(!empty($productDetail['occasion']))
									<tr class="techSpecRow"><td class="techSpecTD1">Occasion:</td><td class="techSpecTD2">{{$productDetail['occasion']}}</td></tr>
									@endif
								</tbody>
							</table>
							
							<h5>Washcare</h5>
							<p>{{$productDetail['wash_care']}}</p>
							<h5>Disclaimer</h5>
							<p>
								There may be a slight color variation between the image shown and original product.
							</p>
						</div>
						<div class="tab-pane fade" id="profile">
							<div id="myTab" class="pull-right">
								<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
								<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
							</div>
							<br class="clr"/>
							<hr class="soft"/>
							<div class="tab-content">
								<div class="tab-pane" id="listView">
									@foreach($relatedProducts as $product)
									<div class="row">
										<div class="span2">
											@if(isset($product['product_image']))
									@php $product_image_path = 'front/images/products/small/'.$product['product_image']; @endphp
								@else 
									@php $product_image_path = ''; @endphp
								@endif
                  	{{-- @php
															$product_image_path = 'front/images/products/small/'.$product['product_image'];
													@endphp --}}
													@if(!empty($product['product_image']) && file_exists($product_image_path))
													<img width="250" height="250" src="{{url('front/images/products/small/'.$product['product_image'])}}" alt="">
													@else 
													<img src="{{url('front/images/products/no-image.png')}}" alt="">
													@endif
										</div>
										<div class="span4">
											<h3>{{$product['product_name']}}</h3>
											<hr class="soft"/>
											<h5>{{$product['product_code']}} </h5>
											<p>
												{{$product['description']}}
											</p>
											<a class="btn btn-small pull-right" href="{{url('product/'.$product['id'])}}">View Details</a>
											<br class="clr"/>
										</div>
										<div class="span3 alignR">
											<form class="form-horizontal qtyFrm">
												<h3> Rs.{{$product['product_price']}}</h3>
												<label class="checkbox">
													<input type="checkbox">  Adds product to compair
												</label><br/>
												<div class="btn-group">
													<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
													<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
												</div>
											</form>
										</div>
									</div>
									<hr class="soft"/>		
									@endforeach				
								</div>

								<div class="tab-pane active" id="blockView">
									<ul class="thumbnails">
										@foreach($relatedProducts as $product)
										<li class="span3">
											<div class="thumbnail">
												<a href="{{url('product/'.$product['id'])}}">
													@if(isset($product['product_image']))
									@php $product_image_path = 'front/images/products/small/'.$product['product_image']; @endphp
								@else 
									@php $product_image_path = ''; @endphp
								@endif
                  	{{-- @php
															$product_image_path = 'front/images/products/small/'.$product['product_image'];
													@endphp --}}
													@if(!empty($product['product_image']) && file_exists($product_image_path))
													<img width="250" height="250" src="{{url('front/images/products/small/'.$product['product_image'])}}" alt="">
													@else 
													<img src="{{url('front/images/products/no-image.png')}}" alt="">
													@endif
												</a>
												<div class="caption">
													<h5>{{$product['product_name']}}</h5>
													<p>
														{{$product['product_code']}}
													</p>
													<h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.{{$product['product_price']}}</a></h4>
												</div>
											</div>
										</li>
										@endforeach		
									</ul>
									<hr class="soft"/>
								</div>
							</div>
							<br class="clr">
						</div>
					</div>
				</div>
			</div>
</div>
@endsection