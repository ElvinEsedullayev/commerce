<!DOCTYPE html>
<html lang="en">
@include('front.layouts.partials.head')
<body>
@include('front.layouts.partials.header')

@if(isset($index_page) && $index_page == 'index')
@include('front.layouts.partials.carusel_slider')
@endif
<div id="mainBody">
	<div class="container">
		<div class="row">
      @include('front.layouts.partials.sidebar')
		  @yield('content')
		</div>
	</div>
</div>
@include('front.layouts.partials.footer')
@include('front.layouts.partials.script')

</body>
</html>