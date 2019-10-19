<?php $__env->startSection('title'); ?>
    <?php if(isset($supplier)): ?>
        Sizes - Edit
    <?php else: ?>
        Sizes - Create
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
                        <?php $__errorArgs = ['max_cm_height'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['max_cm_width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['max_cm_length'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                        <?php echo Form::open(['route' => [isset($size)?'sizes.update':'sizes.store', isset($size)?$size['id']:'']]); ?>

                        <div class="form-group">
                            <?php echo Form::label('title', 'Title');; ?>

                            <?php echo Form::text('title',isset($size)?$size['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('max_cm_height', 'Max Height (cm)');; ?>

                            <?php echo Form::number('max_cm_height',isset($size)?$size['max_cm_height']:'', ['class' => 'form-control', 'placeholder' => 'Max Height (cm)']); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('max_cm_width', 'Max Width (cm)');; ?>

                            <?php echo Form::number('max_cm_width',isset($size)?$size['max_cm_width']:'', ['class' => 'form-control', 'placeholder' => 'Max Width (cm)']); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('max_cm_length', 'Max length (cm)');; ?>

                            <?php echo Form::number('max_cm_length',isset($size)?$size['max_cm_length']:'', ['class' => 'form-control', 'placeholder' => 'Max length (cm)']); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::submit(isset($supplier)?'Update!':'Submit!', ['class' => 'btn btn-primary']); ?>

                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', ['sections' => ['dashboard','Sizes', isset($supplier)?'Edit':'Create']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/sizes/cu.blade.php ENDPATH**/ ?>