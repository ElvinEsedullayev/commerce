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
              <form action="{{url('admin/add-edit-product-attribute/'.$product->id)}}" method="POST" enctype="multipart/form-data">
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
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Attributes</h3>
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
                <form action="{{url('admin/attribute-edit/'.$product['id'])}}" method="POST">
                @csrf
                <table id="attributes" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Size</th>
                    <th>Sku</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($product['attributes'] as $attribute) 
                    <input style="display: none" type="text" name="attributeId[]" value="{{$attribute['id']}}">
                  <tr>
                    <td>{{$attribute->id}}</td>
                   
                    <td>{{$attribute->size}}</td>
                    <td>{{$attribute->sku}}</td>
                    <td>
                    <input style="width: 70px;" type="number" name="price[]" value="{{$attribute['price']}}"></td>     
                    <td>
                    <input style="width: 70px;" type="number" name="stock[]" value="{{$attribute['stock']}}"></td>
                    <td>
                      @if($attribute->status == 1)
                      <a href="Javascript:void(0)" class="updateAttributeStatus" id="attribute-{{$attribute->id}}" attribute_id="{{$attribute->id}}"><i class="fa fa-toggle-on fa-lg"  status="Active"></i></a>
                      @else
                      <a href="Javascript:void(0)" class="updateAttributeStatus" id="attribute-{{$attribute->id}}" attribute_id="{{$attribute->id}}"><i class="fa fa-toggle-off fa-lg"  status="Inactive"></i></a>
                      @endif
                    </td>
                    <td>
                      <a href="Javascript:void(0)" module="attribute" moduleid="{{$attribute->id}}" class="confirmDelete"><i class="fa fa-trash fa-lg text-primary"></i></a> {{--href="{{url('admin/delete-category/'.$category['id'])}}" --}}
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