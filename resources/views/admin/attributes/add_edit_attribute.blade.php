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
              <form  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name: &nbsp;{{$product['product_name']}}</label>                 
                  </div>
  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Code: &nbsp;{{$product['product_code']}}</label>     
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Color: &nbsp;{{$product['product_color']}}</label>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Price: &nbsp;{{$product['product_price']}}</label>
                  </div>
                
                     <div class="form-group">
                    <label for="">Product Image</label>
   
                    @if(!empty($product['product_image']))
                    <br>
                    <img src="{{url('front/images/products/large/'.$product['product_image'])}}" width="150" alt="">
      
                    @endif
                  </div>
                  <div class="form-group">
                    <div class="field_wrapper">
                    <div>
                    <input type="text" name="size[]" placeholder="Size" required style="width: 200px;"/>
                    <input type="text" name="sku[]" placeholder="Sku" required style="width: 200px;"/>
                    <input type="text" name="price[]" placeholder="Price" required style="width: 200px;"/>
                    <input type="text" name="stock[]" placeholder="Stock" required style="width: 200px;"/>
                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                    </div>
                    </div>
                </div>

                </div>
               
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
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