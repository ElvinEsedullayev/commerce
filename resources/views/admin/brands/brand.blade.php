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
                <h3 class="card-title">DataTable with default features</h3>
                <a href="{{url('admin/add-edit-brand')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Yeni</a><br><br>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                 @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
      <strong>Success!</strong> {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
      @endif
                <table id="brands" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                   <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($brands as $brand)
                  <tr>
                    <td>{{$brand->id}}</td>
                    <td>{{$brand->name}}</td>
                    <td>
                      @if($brand->status == 1)
                      <a href="Javascript:void(0)" class="updateBrandStatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}"><i class="fa fa-toggle-on fa-lg"  status="Active"></i></a>
                      @else
                      <a href="Javascript:void(0)" class="updateBrandStatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}"><i class="fa fa-toggle-off fa-lg"  status="Inactive"></i></a>
                      @endif
                    </td>
                    <td>
                      <a href="{{url('admin/add-edit-brand/'.$brand['id'])}}"><i class="fa fa-edit fa-lg"></i></a>
                      <a href="Javascript:void(0)" module="brand" moduleid="{{$brand->id}}" class="confirmDelete"><i class="fa fa-trash fa-lg text-primary"></i></a> {{--href="{{url('admin/delete-category/'.$category['id'])}}" --}}
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
    $("#brands").DataTable();
    
  });
</script>
@endsection