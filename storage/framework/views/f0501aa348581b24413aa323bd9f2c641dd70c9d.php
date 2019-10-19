<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <link rel="stylesheet" href="<?php echo e(asset('resources/plugins/fontawesome-free/css/all.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('resources/plugins/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('resources/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('resources/dist/css/adminlte.min.css')); ?>">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('resources/assets/css/styles.css')); ?>">




</head>
<body class="<?php echo $__env->yieldContent('body-class'); ?>">
<div class="wrapper">
    <?php echo $__env->make('dashboard.parts.main-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.parts.main-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?php echo $__env->yieldContent('title'); ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="breadcrumb-item <?php echo e(($i==count($sections)-1)? "active": ""); ?>">
                                    <?php if($i==0): ?>
                                        <a href="/<?php echo e($section); ?>"><?php echo e(ucfirst($section)); ?></a>
                                    <?php elseif($i==count($sections)-1): ?>
                                        <?php echo e(ucfirst($section)); ?>

                                    <?php else: ?>
                                        <a href="/dashboard/<?php echo e(lcfirst($section)); ?>"><?php echo e($section); ?></a>
                                    <?php endif; ?>
                                </li>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('dashboard.parts.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php echo $__env->make('dashboard.parts.control-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.parts.main-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo e(asset('resources/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('resources/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugins/select2/js/select2.full.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('resources/dist/js/adminlte.min.js')); ?>"></script>
<script>



    $(document).ready(function() {
        $(".suppliers-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2,3]}
            ]
        });
        $(".sizes-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[5]}
            ]
        });
        $(".weights-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[3]}
            ]
        });
        $(".productCategories-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[3]}
            ]
        });
        $(".materialCategories-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".tools-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".products-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[3,4]}
            ]
        });
        $(".materials-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[3]}
            ]
        });
        $(".stocks-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".purchases-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[4]}
            ]
        });
        $(".receipts-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[5]}
            ]
        });
        $(".sells-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[5]}
            ]
        });
        $(".digiStocks-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".packages-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        $(".configs-dataTable").dataTable({
            "columnDefs": [
                { "orderable": false, "targets":[2]}
            ]
        });
        var set_action = function (clicked) {
            window.ajax_action=clicked.getAttribute('data-action');
        };

        $('.row-delete').on('click', function(){
            $this = this;
            $.when(set_action($this)).done(function () {
                $('#delete-yes').on('click', function () {

                    return new Promise((resolve, reject)=> {
                        $.ajax({
                            url: window.ajax_action,
                            type: 'get',
                            success: function() {
                                location.reload();
                                resolve()
                            },
                            error: function(error) {
                                reject(error)
                            },
                        })
                    })
                })
            })
        })

        $('.transfer-product').on('click', function(){
            $this = this;
            var stock_id = $(this).siblings('.select-stock').val();
            var prod_id = $(this).data('prid');
            var qty = $(this).data('qty');
            var pu_id = $(this).data('puid');
            $.when(set_action($this)).done(function () {
                return new Promise((resolve, reject)=> {
                    $.ajax({
                        url: window.ajax_action,
                        type: 'post',
                        data: {
                            'pr_id': prod_id,
                            'st_id': stock_id,
                            'pu_id': pu_id,
                            'qty' : qty,
                            "_token": "<?php echo e(csrf_token()); ?>",
                        },
                        success: function(e) {
                            e.preventDefault();
                            resolve()
                        },
                        error: function(error) {
                            reject(error)
                        },
                    })
                })
            })
        })

    });

</script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/layouts/master.blade.php ENDPATH**/ ?>