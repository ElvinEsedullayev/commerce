@extends('front.layouts.master')
@section('content')
	<div class="span9">
			<ul class="breadcrumb">
				<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
				<li class="active">@php echo $categoryDetails['breadcrumbs'] @endphp </li>
			</ul>
			<h3> {{$categoryDetails['categoryDetails']['category_name']}} <small class="pull-right"> {{count($categoryProduct)}} products are available </small></h3>
			<hr class="soft"/>
			<p>
				{{$categoryDetails['categoryDetails']['description']}}
			</p>
			<hr class="soft"/>
			<form class="form-horizontal span6">
				<div class="control-group">
					<label class="control-label alignL">Sort By </label>
					<select>
						<option>Product name A - Z</option>
						<option>Product name Z - A</option>
						<option>Product Stoke</option>
						<option>Price Lowest first</option>
					</select>
				</div>
			</form>
			
			<div id="myTab" class="pull-right">
				<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
				<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
			</div>
			<br class="clr"/>
			<div class="tab-content">
				<div class="tab-pane" id="listView">
					 @foreach($categoryProduct as $product)
					<div class="row">
						<div class="span2">
							<a href="product_details.html">
                  	@php
															$product_image_path = 'front/images/products/small/'.$product['product_image'];
													@endphp
													@if(!empty($product['product_image']) && file_exists($product_image_path))
													<img width="250" src="{{url('front/images/products/small/'.$product['product_image'])}}" alt="">
													@else 
													<img src="{{url('front/images/products/no-image.png')}}" alt="">
													@endif
                </a>
						</div>
						<div class="span4">
							<h3>{{$product['brand']['name']}}</h3>
							<hr class="soft"/>
							<h5>{{$product['product_name']}}</h5>
							<p>
								{{$product['description']}}
							</p>
							<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
							<br class="clr"/>
						</div>
						<div class="span3 alignR">
							<form class="form-horizontal qtyFrm">
								<h3> ${{$product['product_price']}}</h3>
								<label class="checkbox">
									<input type="checkbox">  Adds product to compair
								</label><br/>
								
								<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
								<a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
								
							</form>
						</div>
					</div>
					<hr class="soft"/>
				@endforeach
				</div>
				<div class="tab-pane  active" id="blockView">
					<ul class="thumbnails">
            @foreach($categoryProduct as $product)
						<li class="span3">
							<div class="thumbnail">
								<a href="product_details.html">
                  	@php
															$product_image_path = 'front/images/products/small/'.$product['product_image'];
													@endphp
													@if(!empty($product['product_image']) && file_exists($product_image_path))
													<img width="250" height="250" src="{{url('front/images/products/small/'.$product['product_image'])}}" alt="">
													@else 
													<img src="{{url('front/images/products/no-image.png')}}" alt="">
													@endif
                </a>
								<div class="caption">
									<h5>{{$product['product_name']}}</h5>
									<p>
										{{-- {{$product['brand']['name']}} --}}
										{{$product['description']}}
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
			<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
			<div class="pagination">
				<ul>
					<li><a href="#">&lsaquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">...</a></li>
					<li><a href="#">&rsaquo;</a></li>
				</ul>
			</div>
			<br class="clr"/>
		</div>
@endsection