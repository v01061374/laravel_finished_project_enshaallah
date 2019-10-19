<?php $__env->startSection('title'); ?>
    <?php if(isset($stock)): ?>
        Stocks - Edit
    <?php else: ?>
        Stocks - Create
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body-class'); ?>
    hold-transition layout-fixed sidebar-mini
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>




            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="alert alert-danger"><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="row">
                        <?php if(session()->has('message')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session()->get('message')); ?>

                            </div>
                        <?php endif; ?>
                        <?php if(session()->has('no-change')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session()->get('no-change')); ?>

                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="row">
                        <?php echo Form::open(['method' => 'POST','route' => [isset($stock)?'stocks.update':'stocks.store', $stock['id'] ?? '']]); ?>

                        
                        <div class="form-group">
                            <?php echo Form::label('title', 'Title');; ?>

                            <?php echo Form::text('title',isset($stock)?$stock['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::submit(isset($stock)?'Update!':'Submit!', ['class' => 'btn btn-primary']); ?>

                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', ['sections' => ['dashboard','Stocks', isset($stock)?'Edit':'Create']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/stocks/cu.blade.php ENDPATH**/ ?>