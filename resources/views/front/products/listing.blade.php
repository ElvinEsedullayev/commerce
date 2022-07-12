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
			<form name="sortProducts" class="form-horizontal span6">
				<input type="hidden" name="url" id="url" value="{{$url}}">{{--frontcontrollerde metodun deyeridi --}}
				<div class="control-group">
					<label class="control-label alignL">Sort By </label>
					<select name="sort" id="sort">
						<option value="">Select</option>
						<option value="latest_products" @if(isset($_GET['sort']) && $_GET['sort'] == 'latest_products') selected @endif>Latest Products</option>
						<option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_a_z') selected @endif>Product name A - Z</option>
						<option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_z_a') selected @endif>Product name Z - A</option>
						<option value="lowest_price" @if(isset($_GET['sort']) && $_GET['sort'] == 'lowest_price') selected @endif>Lowest Price first</option>
						<option value="highest_price" @if(isset($_GET['sort']) && $_GET['sort'] == 'highest_price') selected @endif>Highest Price first</option>
					</select>
				</div>
			</form>
			
			{{-- <div id="myTab" class="pull-right">
				<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
				<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
			</div> --}}
			<br class="clr"/>
			<div class="tab-content filter_products">
				@include('front.products.ajax_product_listing')
			
			</div>
			<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
			<div class="pagination">
				@if(isset($_GET['sort']) && !empty($_GET['sort']))
					{{-- {{$categoryProduct->links()}} --}}
			    {{$categoryProduct->appends(['sort' => $_GET['sort']])->links()}}
				@else 
					{{$categoryProduct->links()}}
					@endif
			</div>
			<br class="clr"/>
		</div>
@endsection