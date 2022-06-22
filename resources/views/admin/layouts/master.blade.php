<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.partials.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

     @include('admin.layouts.partials.header')

    
     @include('admin.layouts.partials.sidebar')
      

       @yield('content')
      
        @include('admin.layouts.partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('admin.layouts.partials.script')
</body>

</html>