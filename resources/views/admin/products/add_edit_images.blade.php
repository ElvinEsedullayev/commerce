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
              <form action="{{url('admin/add-edit-product-images/'.$products->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name: &nbsp;{{$products['product_name']}}</label>                 
                  </div>
  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Code: &nbsp;{{$products['product_code']}}</label>     
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Color: &nbsp;{{$products['product_color']}}</label>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Price: &nbsp;{{$products['product_price']}}</label>
                  </div>
                
                     <div class="form-group">
                    <label for="">Product Image</label>
                     
                    @if(!empty($products['product_image']))
                    <br>
                    <img src="{{url('front/images/products/large/'.$products['product_image'])}}" width="150" alt="">
                       @else
                       <img src="{{url('front/images/products/large/no-image.png')}}" width="150" alt="">
                    @endif
                    <input type="file" name="images[]" multiple="" id="">
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
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Images</h3>
                <a href="{{url('admin/add-edit-product')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Yeni</a><br><br>
              </div>
              <!-- /.card-header -->
              @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
      <strong>Success!</strong> {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
      @endif
              <div class="card-body">
                <form action="{{url('admin/attribute-edit/'.$products['id'])}}" method="POST">
                @csrf
                <table id="attributes" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Status</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($products['images'] as $image) 
                  <tr>
                    <td>{{$image->id}}</td>
                    <td>
                       @php
                          $product_image_path = 'front/images/products/small/'.$image->image;
                      @endphp
                     @if(!empty($image['image']) && file_exists($product_image_path))
                      <img src="{{url('front/images/products/small/'.$image['image'])}}" width="100" alt="">
                      @else
                      <img src="{{url('front/images/products/large/no-image.png')}}" width="100" alt="">
                      @endif
                    </td>
                    <td>
                      @if($image->status == 1)
                      <a href="Javascript:void(0)" class="updateImageStatus" id="image-{{$image->id}}" image_id="{{$image->id}}"><i class="fa fa-toggle-on fa-lg"  status="Active"></i></a>
                      @else
                      <a href="Javascript:void(0)" class="updateImageStatus" id="image-{{$image->id}}" image_id="{{$image->id}}"><i class="fa fa-toggle-off fa-lg"  status="Inactive"></i></a>
                      @endif
                    </td>
                    <td>
                      <a href="Javascript:void(0)" module="image" moduleid="{{$image->id}}" class="confirmDelete"><i class="fa fa-trash fa-lg text-primary"></i></a> {{--href="{{url('admin/delete-category/'.$category['id'])}}" --}}
                    </td>
                  </tr>
                  @endforeach
             
                  </tbody>
             
                </table>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update Attribute</button>
                </div>
                </form>
                
              </div>
              <!-- /.card-body -->
              
          </div>
          <!--/.col (left) -->

@endsection  
@section('js')
<script src="{{url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
  $(function () {
    $("#attributes").DataTable();
    
  });
</script>
@endsection      