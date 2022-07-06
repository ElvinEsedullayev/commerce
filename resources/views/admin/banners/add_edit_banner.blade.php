@extends('admin.layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Admin Catalogues </h1>
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
                <h3 class="card-title">{{$title}}</h3>
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
      <strong>Success!</strong> {{Session::get('success')}}
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
              <form @if(empty($banner['id'])) action="{{url('admin/add-edit-banner')}}" @else action="{{url('admin/add-edit-banner/'.$banner['id'])}}" @endif method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($banner['title'])) value="{{$banner['title']}}" @else value="{{old('title')}}"  @endif name="title">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Alt</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($banner['alt'])) value="{{$banner['alt']}}" @else value="{{old('alt')}}"  @endif name="alt">
                  </div>
                  <div class="form-group">
                   <label for="exampleInputEmail1">Link</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($banner['link'])) value="{{$banner['link']}}" @else value="{{old('link')}}"  @endif name="link">
                  </div>
                     <div class="form-group">
                    <label for="">Banner Image</label>
                    <input type="file" class="form-control" id="exampleInputEmail1" value="" name="banner_image">
                    @if(!empty($banner['banner_image']))
                    <br>
                    <img src="{{url('front/images/banners/'.$banner['banner_image'])}}" width="250" alt="">
                    <a href="Javascript:void(0)" module="banner-image" moduleid="{{$banner->id}}" class="confirmDelete">Delete Image</a>
                    @endif
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
 