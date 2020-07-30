<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">CratifyNetwork</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->guard('admin')->user()->AvatarUrl}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(auth()->guard('admin')->user()->hasAnyPermission(['administration-list','administration-create','administration-edit','administration-delete']) )
                    <li class="nav-item">
                        <a href="{{route('admin.administrations.index')}}" class="nav-link">
                            <i class="nav-icon fas  fa-user-secret"></i>
                            <p>
                                Administration
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->guard('admin')->user()->hasAnyPermission(['user-list','user-create','user-edit','user-delete']) )
                    <li class="nav-item">
                        <a href="{{route('admin.users.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users Management
                            </p>
                        </a>
                    </li>
                @endif


                @if(auth()->guard('admin')->user()->hasAnyPermission(['product-list','product-create','product-edit','product-delete']) )
                    <li class="nav-item">
                        <a href="{{route('admin.products.index')}}" class="nav-link">
                            <i class="nav-icon fas  fa-user-secret"></i>
                            <p>
                                Product
                            </p>
                        </a>
                    </li>
                @endif



                @if(auth()->guard('admin')->user()->hasAnyPermission(['role-list','role-create','role-edit','role-delete']) )

                    <li class="nav-item">
                        <a href="{{route('admin.roles.index')}}" class="nav-link">
                            <i class="fas fa-user-tag"></i>

                            <p>
                                Roles
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth()->guard('admin')->user()->hasAnyPermission(['permission-list']) )

                    <li class="nav-item">
                        <a href="{{route('admin.permissions.index')}}" class="nav-link">
                            <i class="fas fa-genderless"></i>
                            <p>
                                Permissions
                            </p>
                        </a>
                    </li>
                @endif


                <li class="nav-item">
                    <a href="{{route('admin.media.index')}}" class="nav-link">
                        <i class="fas fa-photo-video"></i>
                        <p>
                            Media
                        </p>
                    </a>
                </li>

                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>

                        <p>
                            Logout

                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
