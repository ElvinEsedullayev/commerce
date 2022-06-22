@extends('admin.layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Admin Settings </h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{url('/admin/home')}}">Home</a></li>
                                <li class="breadcrumb-item active">Admin Panel</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

                      <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Admin Details</h3>
              </div>
              <!-- /.card-header -->
              @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
      <strong>Error!</strong> {{Session::get('error_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
      @endif

        @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
      <strong>Error!</strong> {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
      @endif

         @if ($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <!-- form start -->
              <form action="{{url('admin/update-admin-details')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="{{Auth::guard('admin')->user()->email}}" readonly placeholder="Enter email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" readonly value="{{Auth::guard('admin')->user()->type}}" placeholder="Enter email" name="type">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::guard('admin')->user()->name}}" placeholder="Enter Admin Name" name="admin_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Mobile</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" value="{{Auth::guard('admin')->user()->mobile}}" placeholder="Enter Admin Mobile" name="admin_mobile">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Image</label>
                    <input type="file" class="form-control" name="admin_image">
                    @if(!empty(Auth::guard('admin')->user()->image))
                    <a target="_blank" href="{{url('admin/images/admin_image/'.Auth::guard('admin')->user()->image)}}">View Image</a>
                    <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                    @endif
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
  

          </div>
          <!--/.col (left) -->

        </div>
        
@endsection        