  <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('admin/home')}}" class="brand-link">
                <img src="{{url('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{url('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ucwords(Auth::guard('admin')->user()->name)}}</a>
                    </div>
                </div>

          

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                         <li class="nav-item menu-open">
                             @if(Session::get('page') ==  'home')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                            <a href="{{url('admin/home')}}" class="nav-link {{$active}}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Admin Home

                                </p>
                            </a>
                        </li>
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            @if(Session::get('page') ==  'settings' or Session::get('page') ==  'update-admin-details')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                            <a href="{{url('admin/settings')}}" class="nav-link {{$active}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Admin Settings
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                 @if(Session::get('page') ==  'settings')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                                    <a href="{{url('admin/settings')}}" class="nav-link {{$active}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Update Admin Pasword</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    @if(Session::get('page') ==  'update-admin-details')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                                    <a href="{{url('admin/update-admin-details')}}" class="nav-link {{$active}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Update Admin Details</p>
                                    </a>
                                </li>                            
                            </ul>
                        </li>

                         <li class="nav-item menu-open">
                            @if(Session::get('page') ==  'categories' or Session::get('page') == 'sections' or Session::get('page') == 'products' or Session::get('page') == 'brands' or Session::get('page') == 'banners')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                            <a href="{{url('admin/categories')}}" class="nav-link {{$active}}">
                                <i class="nav-icon fas fa-album-collection"></i>
                                <p>
                                    Catalogues
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                 @if(Session::get('page') ==  'sections')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                                    <a href="{{url('admin/sections')}}" class="nav-link {{$active}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sections</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                 @if(Session::get('page') ==  'brands')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                                    <a href="{{url('admin/brands')}}" class="nav-link {{$active}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Brands</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                 @if(Session::get('page') ==  'banners')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                                    <a href="{{url('admin/banners')}}" class="nav-link {{$active}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Banners</p>
                                    </a>
                                </li>
                                  <li class="nav-item">
                                 @if(Session::get('page') ==  'categories')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                                    <a href="{{url('admin/categories')}}" class="nav-link {{$active}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                 @if(Session::get('page') ==  'products')
                             @php $active = 'active'; @endphp
                             @else
                              @php $active = ''; @endphp
                              @endif
                                    <a href="{{url('admin/products')}}" class="nav-link {{$active}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Products</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>