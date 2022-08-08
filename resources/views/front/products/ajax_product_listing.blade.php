	@php
			use App\Models\Product;
	@endphp
	<div class="tab-pane  active" id="blockView">
					<ul class="thumbnails">
            @foreach($categoryProduct as $product)
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
										{{-- {{$product['brand']['name']}} --}}
										{{$product['description']}}
									</p>
									@php
											$discount_price = Product::getDiscountedProduct($product['id']);
									@endphp
									<h4 style="text-align:center">
										{{-- <a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> --}}
										 <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 
										<a class="btn btn-primary" href="#">
											@if($discount_price > 0)
											<del>$.{{$product['product_price']}}</del>
											<font color="yellow">&nbsp;$.{{$discount_price}}</font>
											@else 
											$.{{$product['product_price']}}
											@endif
										</a>
									</h4>
									{{-- @if($discount_price > 0)
									<h4><font color="red">Discount Price : {{$discount_price}}</font></h4>
									@endif --}}
								
										{{-- {{$product['brand']['name']}} --}}
										{{-- {{$product['fabric']}} <br>
										{{$product['sleeve']}} <br>
										{{$product['pattern']}} <br>
										{{$product['fit']}} <br>
										{{$product['occasion']}} <br> --}}
								
								</div>
							</div>
						</li>
					@endforeach
					</ul>
					<hr class="soft"/>
				</div>