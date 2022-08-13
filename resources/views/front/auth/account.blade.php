@extends('front.layouts.master')
@section('content')
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> My Account</h3>	
	<hr class="soft"/>
		@if(Session::has('error_message'))
      <div class="alert alert-danger" role="alert">
      <strong>Error!</strong> {{Session::get('error_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
      @endif
      			@if(Session::has('success'))
      <div class="alert alert-success" role="alert">
      <strong>Success!</strong> {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
      @endif
	<div class="row">
		<div class="span4">
		
			<div class="well">
			<h5>CREATE YOUR ACCOUNT</h5><br/>
			Enter YOUR CONTACT DETAIL<br/><br/><br/>
			<form action="{{url('account')}}" method="post" id="accountForm">
				@csrf
        <div class="control-group">
				<label class="control-label" for="name">Name</label>
				<div class="controls">
				  <input class="span3"  type="text" id="name" required name="name" value="{{$userDetail['name']}}" placeholder="Name" pattern="[A-Za-z]+">
				</div>
			  </div>
        <div class="control-group">
				<label class="control-label" for="name">Address</label>
				<div class="controls">
				  <input class="span3"  type="text" id="address" name="address" value="{{$userDetail['address']}}" placeholder="Address">
				</div>
			  </div>
        <div class="control-group">
				<label class="control-label" for="name">City</label>
				<div class="controls">
				  <input class="span3"  type="text" id="city" name="city" value="{{$userDetail['city']}}" placeholder="City">
				</div>
			  </div>
        <div class="control-group">
				<label class="control-label" for="name">State</label>
				<div class="controls">
				  <input class="span3"  type="text" id="state" name="state" value="{{$userDetail['state']}}" placeholder="State">
				</div>
			  </div>
        <div class="control-group">
				<label class="control-label" for="name">Country</label>
				<div class="controls">
				  <input class="span3"  type="text" id="country" name="country" value="{{$userDetail['country']}}" placeholder="Country">
				</div>
			  </div>
        <div class="control-group">
				<label class="control-label" for="name">Pincode</label>
				<div class="controls">
				  <input class="span3"  type="text" id="pincode" name="pincode" value="{{$userDetail['pincode']}}" placeholder="Pincode">
				</div>
			  </div>
        <div class="control-group">
				<label class="control-label" for="mobile">Mobile</label>
				<div class="controls">
				  <input class="span3"  type="text" id="mobile" name="mobile" value="{{$userDetail['mobile']}}" placeholder="Mobile">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="email">E-mail address</label>
				<div class="controls">
				  <input class="span3"  type="email" disabled id="email" name="email" value="{{$userDetail['email']}}" placeholder="Email">
				</div>
			  </div>
      
			  <div class="controls">
			  <button type="submit" class="btn block">Update</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>Update Password</h5>
			<form action="{{url('/login')}}" method="post" id="loginForm">
				@csrf
			  <div class="control-group">
				<label class="control-label" for="inputEmail1">Current Password</label>
				<div class="controls">
				  <input class="span3"  type="password" name="current_password" id="current_password" placeholder="Current Password">
				</div>
			  </div>
			    <div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
				  <input class="span3"  type="password" id="password" name="password" placeholder="Password">
				</div>
			  </div>
          <div class="control-group">
				<label class="control-label" for="password">New Password</label>
				<div class="controls">
				  <input class="span3"  type="password" id="new_password" name="new_password" placeholder="New Password">
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn">Update</button>
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>

@endsection