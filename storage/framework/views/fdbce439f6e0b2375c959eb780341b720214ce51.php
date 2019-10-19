<?php $__env->startSection('title'); ?>
    Unstocked Equipments
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
                <h2>Products</h2>
                <div class="row">
                    <div class="col-sm-12">
                        
                        <table class="table table-bordered table-hover dataTable purchases-dataTable" role="grid">
                            <thead>
                                <tr>
                                    
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Product Title</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Quantity</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Purchase Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Specify Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $unstockedPurchases['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $unstockedPurchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="sorting_1">
                                            <?php echo e($i+1); ?>

                                        </td>
                                        <td>
                                            <?php echo e($unstockedPurchase['product']['title']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($unstockedPurchase['product']['pivot']['qty']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($unstockedPurchase['date']); ?>

                                        </td>

                                        <td id="row-actions">
                                            <?php echo Form::select('stock_id',$stocks,'',['class' => 'form-control select-stock', 'style'=>'float: left; width: auto;']); ?>

                                            <i title="Transfer To Stock" style="float: left;margin-left: 10px; margin-top: 10px; color: green; margin-right: 5px; cursor: pointer;" class="transfer-product fas fa-check" data-action="<?php echo e(route('purchases.products.specify')); ?>" data-qty = "<?php echo e($unstockedPurchase['product']['pivot']['qty']); ?>" data-prid="<?php echo e(\App\CustomClasses\Hasher::encode($unstockedPurchase['product']['id'])); ?>" data-puid="<?php echo e(\App\CustomClasses\Hasher::encode($unstockedPurchase['purchase_id'])); ?>"></i>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Product Title</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Quantity</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Purchase Date</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Specify Stock</th>
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


<?php echo $__env->make('dashboard.layouts.master', ['sections' => ['dashboard','Purchases', 'unstocked']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/purchases/unstocked.blade.php ENDPATH**/ ?>