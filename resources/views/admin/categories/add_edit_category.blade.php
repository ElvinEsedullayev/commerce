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
              <form @if(empty($category['id'])) action="{{url('admin/add-edit-category')}}" @else action="{{url('admin/add-edit-category/'.$category['id'])}}" @endif method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($category['category_name'])) value="{{$category['category_name']}}" @else value="{{old('category_name')}}"  @endif name="category_name">
                  </div>
                  <div class="form-group">
                    <label for="">Select Section</label>
                    <select name="section_id" id="section_id" class="form-control">
                      <option value="">Select</option>
                      @foreach($sections as $section)
                      <option value="{{$section->id}}" @if(!empty($category['section_id'] && $category['section_id'] == $section->id)) selected @endif>{{$section->name}}</option>
                      @endforeach
                    </select>
                  </div>
                 <div id="appendCategoryLevel">
                  @include('admin.categories.append_category_level')
                 </div>
                     <div class="form-group">
                    <label for="">Category Image</label>
                    <input type="file" class="form-control" id="exampleInputEmail1" value="" name="category_image">
                    @if(!empty($category['category_image']))
                    <br>
                    <img src="{{url('front/images/categories/'.$category['category_image'])}}" width="100" alt="">
                    <a href="Javascript:void(0)" module="category-image" moduleid="{{$category->id}}" class="confirmDelete">Delete Image</a>
                    @endif
                  </div>
                   <div class="form-group">
                    <label for="">Category Discount</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($category['discount'])) value="{{$category['discount']}}"  @else value="{{old('discount')}}" @endif name="discount">
                  </div>
                   <div class="form-group">
                    <label for="">Category Url</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($category['url'])) value="{{$category['url']}}"  @else value="{{old('url')}}"  @endif name="url">
                  </div>
                   <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control">@if(!empty($category['discount'])) {{$category['discount']}} @else {{old('description')}}  @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Meta Title</label>
                    <textarea name="meta_title" id="" cols="30" rows="5" class="form-control">@if(!empty($category['meta_title'])) {{$category['meta_title']}} @else {{old('meta_title')}}  @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">MEta Description</label>
                    <textarea name="meta_description" id="" cols="30" rows="5" class="form-control">@if(!empty($category['meta_description'])) {{$category['meta_description']}} @else {{old('meta_description')}}  @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Meta Keywords</label>
                    <textarea name="meta_keywords" id="" cols="30" rows="5" class="form-control">@if(!empty($category['meta_keywords']))  {{$category['meta_keywords']}} @else {{old('meta_keywords')}} @endif</textarea>
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
@section('js')
<!-- Select2 -->
<script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
 
    //Initialize Select2 Elements
    $('.select2').select2();
  

  </script>
@endsection      