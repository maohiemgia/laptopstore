<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> --}}
        <!-- Sidebar user panel (optional) -->
        @if (isset(Auth::user()->name))
            <li class="nav-item dropdown px-3">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/">{{ __('Giao diện khách') }}</a>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Quản lý tài khoản') }}</a>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="dropdown-item" href="route('logout')"
                            onclick="event.preventDefault();
                                     this.closest('form').submit();">
                            {{ __('Đăng xuất') }}
                        </a>
                    </form>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link btn btn-secondary text-white" href="/login" role="button">
                    Đăng nhập
                </a>
            </li>
        @endif
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/"
        class="d-block mb-3 brand-link brand-text bg-danger text-white text-uppercase px-3 mx-auto font-weight-bold d-none d-lg-block text-center">
        typhoon
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text-capitalize">
                            bảng điều khiển
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p class="text-capitalize">
                            Quản lý user
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/users" class="nav-link">
                                <p class="text-capitalize d-flex align-items-center">
                                    <span class="fa-2x pl-4 pr-3">+</span>
                                    Danh sách
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users/create" class="nav-link">
                                <p class="text-capitalize d-flex align-items-center">
                                    <span class="fa-2x pl-4 pr-3">+</span>
                                    tạo mới
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p class="text-capitalize">
                            Quản lý danh mục
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/categories" class="nav-link">
                                <p class="text-capitalize d-flex align-items-center">
                                    <span class="fa-2x pl-4 pr-3">+</span>
                                    Danh sách
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/categories/create" class="nav-link">
                                <p class="text-capitalize d-flex align-items-center">
                                    <span class="fa-2x pl-4 pr-3">+</span>
                                    tạo mới
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p class="text-capitalize">
                            Quản lý sản phẩm
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/products" class="nav-link">
                                <p class="text-capitalize d-flex align-items-center">
                                    <span class="fa-2x pl-4 pr-3">+</span>
                                    Danh sách
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/products/create" class="nav-link">
                                <p class="text-capitalize d-flex align-items-center">
                                    <span class="fa-2x pl-4 pr-3">+</span>
                                    tạo mới
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/orders" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p class="text-capitalize">
                            Quản lý đơn hàng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p class="text-capitalize">
                            Quản lý mã giảm giá
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/vouchers" class="nav-link">
                                <p class="text-capitalize d-flex align-items-center">
                                    <span class="fa-2x pl-4 pr-3">+</span>
                                    Danh sách
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/vouchers/create" class="nav-link">
                                <p class="text-capitalize d-flex align-items-center">
                                    <span class="fa-2x pl-4 pr-3">+</span>
                                    Tạo mới
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>





                {{-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Layout Options
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/layout/top-nav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation + Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/boxed.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Boxed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar <small>+ Custom Area</small></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Navbar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-footer.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Footer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Collapsed Sidebar</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
