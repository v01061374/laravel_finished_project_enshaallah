<?php $__env->startSection('title'); ?>
    Purchases
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body-class'); ?>
    hold-transition layout-fixed sidebar-mini
<?php $__env->stopSection(); ?>

    <!-- Content Wrapper. Contains page content -->

        <!-- /.content-header -->
<?php $__env->startSection('content'); ?>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message')); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <div class="row mb-5">
                    <a href="<?php echo e(route('purchases.create')); ?>">
                        <button type="button" class="btn btn-block btn-primary">
                            <i class="far fa-plus-square"></i>
                            Add new
                        </button>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable purchases-dataTable" role="grid">
                            <thead>
                                <tr>
                                    
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Supplier</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Side Costs</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Total Price</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="sorting_1">
                                            <?php echo e($i+1); ?>

                                        </td>
                                        <td>
                                            <?php echo e($purchase['date']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($purchase['supplier']['title']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($purchase['side_costs']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($purchase['total_price']); ?>

                                        </td>
                                        <td id="row-actions">
                                            <a href="" title="details"><i  style="color: #869099; margin-right: 5px;" class="fas fa-eye"></i></a>
                                                
                                            <a title="edit" href="<?php echo e(route('purchases.edit', ['id' => \App\CustomClasses\Hasher::encode($purchase['id'])])); ?>"><i style="color: #869099; margin-right: 5px;" class="fas fa-edit"></i></a>
                                            <i title="delete" class="row-delete fas fa-trash-alt" data-toggle="modal" data-target="#modal-delete" style="color: red; margin-right: 5px; cursor: pointer;" data-action="<?php echo e(route('purchases.products.specify',\App\CustomClasses\Hasher::encode($purchase['id']))); ?>"></i>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Supplier</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Side Costs</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Total Cost</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.c <tent -->

    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('dashboard.layouts.master', ['sections' => ['dashboard','Purchases']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/purchases/index.blade.php ENDPATH**/ ?>