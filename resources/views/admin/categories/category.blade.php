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
                <h3 class="card-title">Categories</h3>
                <a href="{{url('admin/add-edit-category')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Yeni</a><br><br>
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
                <table id="categories" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Parent Category</th>
                    <th>Section</th>
                    <th>Url</th>
                    <th>Status</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                    @if(!isset($category->parentcategory->category_name))
                      @php $parent_category = 'Root'; @endphp
                      @else 
                      @php $parent_category = $category->parentcategory->category_name @endphp
                    @endif
                  <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->category_name}}</td>
                    <td>{{$parent_category}}</td>
                    
                    <td>{{$category->section->name}}</td>
                    <td>{{$category->url}}</td>
                    <td>
                      @if($category->status == 1)
                      <a href="Javascript:void(0)" class="updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}"><i class="fa fa-toggle-on fa-lg"  status="Active"></i></a>
                      @else
                      <a href="Javascript:void(0)" class="updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}"><i class="fa fa-toggle-off fa-lg"  status="Inactive"></i></a>
                      @endif
                    </td>
                    <td>
                      <a href="{{url('admin/add-edit-category/'.$category['id'])}}"><i class="fa fa-edit fa-lg"></i></a>
                      <a href="Javascript:void(0)" module="category" moduleid="{{$category->id}}" class="confirmDelete"><i class="fa fa-trash fa-lg text-danger"></i></a> {{--href="{{url('admin/delete-category/'.$category['id'])}}" --}}
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
    $("#categories").DataTable();
    
  });
</script>
@endsection