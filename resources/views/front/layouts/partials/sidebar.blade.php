@php
use App\Models\Section;
$sections = Section::sections();		
@endphp
		<!-- Sidebar ================================================== -->
			<div id="sidebar" class="span3">
				<div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{url('front/images/ico-cart.png')}}" alt="cart">3 Items in your cart</a></div>
				<ul id="sideManu" class="nav nav-tabs nav-stacked">
					@foreach($sections as $section)
					<li class="subMenu"><a>{{Str::upper($section['name'])}}</a>
						@foreach($section['category'] as $category)
						<ul>
							<li><a href="products.html"><i class="icon-chevron-right"></i><strong>{{$category['category_name']}}</strong></a></li>
							@foreach($category['subcategories'] as $subcategory)
							<li><a href="products.html"><i class="icon-chevron-right"></i>{{$subcategory['category_name']}}</a></li>
							@endforeach
						</ul>
				@endforeach
					</li>
					@endforeach
				</ul>
				<br/>
				<div class="thumbnail">
					<img src="{{url('front/images/payment_methods.png')}}" title="Payment Methods" alt="Payments Methods">
					<div class="caption">
						<h5>Payment Methods</h5>
					</div>
				</div>
			</div>
			<!-- Sidebar end=============================================== -->