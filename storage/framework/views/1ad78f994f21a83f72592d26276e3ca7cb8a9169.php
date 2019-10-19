<?php $__env->startSection('title'); ?>
    Sizes
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
                    <a href="<?php echo e(route('sizes.create')); ?>">
                        <button type="button" class="btn btn-block btn-primary">
                            <i class="far fa-plus-square"></i>
                            Add new
                        </button>
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable sizes-dataTable" role="grid">
                            <thead>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Title</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Max Height (cm)</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Max Width (cm)</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Max Length (cm)</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="sorting_1">
                                            <?php echo e($i+1); ?>

                                        </td>
                                        <td>
                                            <?php echo e($size['title']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($size['max_cm_height']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($size['max_cm_width']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($size['max_cm_length']); ?>

                                        </td>
                                        <td id="row-actions">
                                            <a href="" title="details"><i  style="color: #869099; margin-right: 5px;" class="fas fa-eye"></i></a>
                                                
                                            <a title="edit" href="<?php echo e(route('sizes.edit', ['id' => \App\CustomClasses\Hasher::encode($size['id'])])); ?>"><i style="color: #869099; margin-right: 5px;" class="fas fa-edit"></i></a>
                                            <i title="delete" class="row-delete fas fa-trash-alt" data-toggle="modal" data-target="#modal-delete" style="color: red; margin-right: 5px; cursor: pointer;" data-action="<?php echo e(route('sizes.delete',\App\CustomClasses\Hasher::encode($size['id']))); ?>"></i>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" class="sorting_asc">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Title</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Max Height (cm)</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Max Width (cm)</th>
                                    <th tabindex="0" rowspan="1" colspan="1" class="sorting">Max Length (cm)</th>
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


<?php echo $__env->make('dashboard.layouts.master', ['sections' => ['dashboard','Sizes']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/sizes/index.blade.php ENDPATH**/ ?>