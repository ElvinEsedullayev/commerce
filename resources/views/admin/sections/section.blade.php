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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="section" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($sections as $section)
                  <tr>
                    <td>{{$section->id}}</td>
                    <td>{{$section->name}}</td>
                    <td>
                      @if($section->status == 1)
                      <a href="Javascript:void(0)" class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}"><i class="fa fa-toggle-on fa-lg"  status="Active"></i></a>
                      @else
                      <a href="Javascript:void(0)" class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}"><i class="fa fa-toggle-off fa-lg"  status="Inactive"></i></a>
                      @endif
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
    $("#section").DataTable();
    
  });
</script>
@endsection