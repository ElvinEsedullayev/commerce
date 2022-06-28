@extends('admin.layouts.master')
@section('css')
<!-- DataTables -->
 
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
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

          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products</h3>
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
                <table id="products" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Section</th>
                    <th>Product Image</th>
                    <th>Product Color</th>
                    <th>Product Code</th>
                    <th>Status</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                  
                  <tr>
                    <td>{{$product->id}}</td>
                   
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->category->category_name}}</td>
                    <td>{{$product->section->name}}</td>
                    <td>
                      @php
                          $product_image_path = 'front/images/products/small/'.$product->product_image;
                      @endphp
                      @if(!empty($product['product_image']) && file_exists($product_image_path))
                      <img src="{{url('front/images/products/small/'.$product['product_image'])}}" width="100" alt="">
                      @else
                      <img src="{{url('front/images/products/large/no-image.png')}}" width="100" alt="">
                      @endif
                    <td>{{$product->product_color}}</td>
                    <td>{{$product->product_code}}</td>
                    <td>
                      @if($product->status == 1)
                      <a href="Javascript:void(0)" class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}"><i class="fa fa-toggle-on fa-lg"  status="Active"></i></a>
                      @else
                      <a href="Javascript:void(0)" class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}"><i class="fa fa-toggle-off fa-lg"  status="Inactive"></i></a>
                      @endif
                    </td>
                    <td style="width: 100px;">
                      <a href="{{url('admin/add-edit-product-attribute/'.$product['id'])}}"><i class="fa fa-plus fa-lg"></i></a>
                      <a href="{{url('admin/add-edit-product/'.$product['id'])}}"><i class="fa fa-edit fa-lg"></i></a>
                      <a href="{{url('admin/add-edit-product-images/'.$product['id'])}}"><i class="fa fa-images fa-lg"></i></a>
                      <a href="Javascript:void(0)" module="product" moduleid="{{$product->id}}" class="confirmDelete"><i class="fa fa-trash fa-lg text-primary"></i></a> {{--href="{{url('admin/delete-category/'.$category['id'])}}" --}}
                    </td>
                  </tr>
                  @endforeach
             
                  </tbody>
             
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
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
    $("#products").DataTable();
    
  });
</script>
@endsection