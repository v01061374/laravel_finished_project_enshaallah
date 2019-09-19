<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('resources/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('resources/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('suppliers.index')}}" class="nav-link  {{(strpos(request()->getUri(), substr(route('suppliers.index', [], false), 1))) ? 'active' : ''}}">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    Suppliers
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('sizes.index')}}" class="nav-link  {{(strpos(request()->getUri(), substr(route('sizes.index', [], false), 1))) ? 'active' : ''}}">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Sizes
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('weights.index')}}" class="nav-link  {{(strpos(request()->getUri(), substr(route('weights.index', [], false), 1))) ? 'active' : ''}}">
                                <i class="nav-icon fas fa-weight"></i>
                                <p>
                                    Weights
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('productCategories.index')}}" class="nav-link  {{(strpos(request()->getUri(), substr(route('productCategories.index', [], false), 1))) ? 'active' : ''}}">
                                <i class="nav-icon fas fa-grip-lines-vertical"></i>
                                <p>
                                    Product Categories
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-vials"></i>
                        <p>
                            Materials
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('materialCategories.index')}}" class="nav-link  {{(strpos(request()->getUri(), substr(route('materialCategories.index', [], false), 1))) ? 'active' : ''}}">
                                <i class="nav-icon fas fa-grip-lines-vertical"></i>
                                <p>
                                    Material Categories
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('tools.index')}}" class="nav-link  {{(strpos(request()->getUri(), substr(route('tools.index', [], false), 1))) ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Tools
                        </p>
                    </a>
                </li>
                {{--<li class="nav-item has-treeview">--}}
                    {{--<a href="{{route('suppliers.index')}}" class="nav-link">--}}
                        {{--<i class="nav-icon fas fa-chart-pie"></i>--}}
                        {{--<p>--}}
                            {{--Suppliers--}}
                            {{--<i class="right fas fa-angle-left"></i>--}}
                        {{--</p>--}}
                    {{--</a>--}}
                    {{--<ul class="nav nav-treeview" style="display: block;">--}}
                        {{--<li class="nav-item">--}}
                            {{--<a href=".{{route('s')}}" class="nav-link">--}}
                                {{--<i class="far fa-circle nav-icon"></i>--}}
                                {{--<p>ChartJS</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a href="../charts/flot.html" class="nav-link">--}}
                                {{--<i class="far fa-circle nav-icon"></i>--}}
                                {{--<p>Flot</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a href="../charts/inline.html" class="nav-link">--}}
                                {{--<i class="far fa-circle nav-icon"></i>--}}
                                {{--<p>Inline</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>