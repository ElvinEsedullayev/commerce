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
              <form @if(empty($product['id'])) action="{{url('admin/add-edit-product')}}" @else action="{{url('admin/add-edit-product/'.$product['id'])}}" @endif method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($product['product_name'])) value="{{$product['product_name']}}" @else value="{{old('product_name')}}"  @endif name="product_name">
                  </div>
                  <div class="form-group">
                    <label for="">Select Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                      <option value="">Select</option>
                    @foreach($categories as $section)
                    <optgroup label="{{$section['name']}}"></optgroup>
                    
                    @foreach($section['category'] as $category)
                    <option value="{{$category['id']}}" @if(!empty($product['category_id']) && $product['category_id'] == $category['id']) selected @endif>&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{$category['category_name']}}</option> 
                    @foreach($category['subcategories'] as $subcategories)
                    <option value="{{$subcategories['id']}}"@if(!empty($product['category_id']) && $product['category_id'] == $subcategories['id']) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{$subcategories['category_name']}}</option>
                    @endforeach
                    @endforeach
                    @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Select Brand</label>
                    <select name="brand_id" id="fabric" class="form-control">
                      <option value="">Select Brand</option>
                      @foreach($brands as $brand)
                      <option value="{{$brand['id']}}" @if(!empty($product['brand_id'] && $product['brand_id'] ==  $brand['id'])) selected @endif>{{$brand['name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Select Fabric</label>
                    <select name="fabric" id="fabric" class="form-control">
                      <option value="">Select Fabric</option>
                      @foreach($fabricArray as $fabric)
                      <option value="{{$fabric}}" @if(!empty($product['fabric'] && $product['fabric'] ==  $fabric)) selected @endif>{{$fabric}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Select Sleeve</label>
                    <select name="sleeve" id="sleeve" class="form-control">
                      <option value="">Select Sleeve</option>
                      @foreach($sleeveArray as $sleeve)
                      <option value="{{$sleeve}}" @if(!empty($product['sleeve'] && $product['sleeve'] ==  $sleeve)) selected @endif>{{$sleeve}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Select Pattern</label>
                    <select name="pattern" id="pattern" class="form-control">
                      <option value="">Select Pattern</option>
                      @foreach($patternArray as $pattern)
                      <option value="{{$pattern}}" @if(!empty($product['pattern'] && $product['pattern'] ==  $pattern)) selected @endif>{{$pattern}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Select Fit</label>
                    <select name="fit" id="fit" class="form-control">
                      <option value="">Select Fit</option>
                      @foreach($fitArray as $fit)
                      <option value="{{$fit}}" @if(!empty($product['fit'] && $product['fit'] ==  $fit)) selected @endif>{{$fit}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Select Occasion</label>
                    <select name="occasion" id="occasion" class="form-control">
                      <option value="">Select Occasion</option>
                      @foreach($occasionArray as $occasion)
                      <option value="{{$occasion}}" @if(!empty($product['occasion'] && $product['occasion'] ==  $occasion)) selected @endif>{{$occasion}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Code</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($product['product_code'])) value="{{$product['product_code']}}" @else value="{{old('product_code')}}"  @endif name="product_code">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Color</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($product['product_color'])) value="{{$product['product_color']}}" @else value="{{old('product_color')}}"  @endif name="product_color">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Price</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($product['product_price'])) value="{{$product['product_price']}}" @else value="{{old('product_price')}}"  @endif name="product_price">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Weight</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($product['product_weight'])) value="{{$product['product_weight']}}" @else value="{{old('product_weight')}}"  @endif name="product_weight">
                  </div>
                     <div class="form-group">
                    <label for="">Product Image</label>
                    <input type="file" class="form-control" value="" name="product_image">
                    @if(!empty($product['product_image']))
                    <br>
                    <img src="{{url('front/images/products/large/'.$product['product_image'])}}" width="100" alt="">
                    <a href="Javascript:void(0)" module="product-image" moduleid="{{$product->id}}" class="confirmDelete">Delete Image</a>
                    @endif
                  </div>
                   <div class="form-group">
                    <label for="">Product Video</label>
                    <input type="file" class="form-control" id="exampleInputEmail1" value="" name="product_video">
                    @if(!empty($product['product_video']))
                    <br>
                    <div>
                      <a target="_blank" href="{{url('front/videos/products/'.$product['product_video'])}}" download="" width="100" alt="">Download</a>
                     &nbsp;|&nbsp;
                    <a href="Javascript:void(0)" module="product-video" moduleid="{{$product->id}}" class="confirmDelete">Delete Video</a>
                    </div> 
                    @endif
                  </div>
                   <div class="form-group">
                    <label for="">Product Discount (%)</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" @if(!empty($product['product_discount'])) value="{{$product['product_discount']}}"  @else value="{{old('product_discount')}}" @endif name="product_discount">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Wash Care</label>
                    <textarea name="wash_care" id="" cols="30" rows="5" class="form-control">@if(!empty($product['wash_care'])) {{$product['wash_care']}} @else {{old('wash_care')}}  @endif</textarea>
                  </div>
                   <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control">@if(!empty($product['description'])) {{$product['description']}} @else {{old('description')}}  @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Meta Title</label>
                    <textarea name="meta_title" id="" cols="30" rows="5" class="form-control">@if(!empty($product['meta_title'])) {{$product['meta_title']}} @else {{old('meta_title')}}  @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">MEta Description</label>
                    <textarea name="meta_description" id="" cols="30" rows="5" class="form-control">@if(!empty($product['meta_description'])) {{$product['meta_description']}} @else {{old('meta_description')}}  @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Meta Keywords</label>
                    <textarea name="meta_keywords" id="" cols="30" rows="5" class="form-control">@if(!empty($product['meta_keywords']))  {{$product['meta_keywords']}} @else {{old('meta_keywords')}} @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Featured</label>
                    <input type="checkbox" @if(!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked @endif name="is_featured" value="Yes">
                  </div>
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