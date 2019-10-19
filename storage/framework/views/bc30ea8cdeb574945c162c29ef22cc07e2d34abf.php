<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('dashboard')); ?>" class="brand-link">
        <img src="<?php echo e(asset('resources/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Anbarika</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(asset('resources/dist/img/user2-160x160.jpg')); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Vahid</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo e(route('products.index')); ?>" class="nav-link <?php echo e((strpos(request()->getUri(), substr(route('products.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Products

                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('sizes.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('sizes.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Sizes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('weights.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('weights.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-weight"></i>
                        <p>
                            Weights
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('productCategories.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('productCategories.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-grip-lines-vertical"></i>
                        <p>
                            Product Categories
                        </p>
                    </a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo e(route('materials.index')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-vials"></i>
                        <p>
                            Materials
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('materialCategories.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('materialCategories.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-grip-lines-vertical"></i>
                        <p>
                            Material Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('suppliers.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('suppliers.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Suppliers
                        </p>
                    </a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item">
                    <a href="<?php echo e(route('tools.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('tools.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Tools
                        </p>
                    </a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item">
                    <a href="<?php echo e(route('stocks.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('stocks.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-dolly"></i>
                        <p>
                            Stocks
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('digiStocks.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('digiStocks.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-dolly-flatbed"></i>
                        <p>
                            Digi Stocks
                        </p>
                    </a>
                </li>

                <li class="nav-divider"></li>
                <li class="nav-item">
                    <a href="<?php echo e(route('purchases.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('purchases.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Purchases
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('purchases.unstocked')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('purchases.unstocked', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-dolly"></i>
                        <p>
                            Unstocked Equipments
                        </p>
                    </a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item">
                    <a href="<?php echo e(route('receipts.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('receipts.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>
                            Receipts
                        </p>
                    </a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item">
                    <a href="<?php echo e(route('sells.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('sells.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Sells
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('packages.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('packages.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-motorcycle"></i>
                        <p>
                            Packages
                        </p>
                    </a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item">
                    <a href="<?php echo e(route('configs.index')); ?>" class="nav-link  <?php echo e((strpos(request()->getUri(), substr(route('configs.index', [], false), 1))) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            Configs
                        </p>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside><?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/parts/main-sidebar.blade.php ENDPATH**/ ?>