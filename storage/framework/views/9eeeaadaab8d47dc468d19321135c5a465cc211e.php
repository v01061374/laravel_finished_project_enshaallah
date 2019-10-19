<?php $__env->startSection('title'); ?>
    <?php if(isset($product)): ?>
        Products - Edit
    <?php else: ?>
        Products - Create
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
                        <?php echo Form::open( ['route' => [isset($product)?'products.update':'products.store', isset($product)?$product['id']:''], 'files' => true]); ?>

                        <div class="form-group">
                            <?php echo Form::label('title', 'Title');; ?>

                            <?php echo Form::text('title',isset($product)?$product['title']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('avg_minute_prod_time', 'Average production time (min)');; ?>

                            <?php echo Form::number('avg_minute_prod_time',isset($product)?$product['avg_minute_prod_time']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'Average production time (min)' ]); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('size_id', 'Size');; ?>

                            <?php echo Form::select('size_id',$sizes,isset($product)?$product['size_id']:'',['required'=>'required', 'class' => 'form-control']); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('weight_id', 'Weight');; ?>

                            <?php echo Form::select('weight_id',$weights,isset($product)?\App\CustomClasses\Hasher::encode($product['weight_id']):'',['required'=>'required', 'class' => 'form-control']); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('category_id', 'Category');; ?>

                            <?php echo Form::select('category_id',$productCategories,isset($product)?\App\CustomClasses\Hasher::encode($product['category_id']):'',['required'=>'required', 'class' => 'form-control']); ?>

                        </div>
                        <?php if(isset($product)): ?>
                        <img src="<?php echo e(asset($product['image'])); ?>" alt="" class="img-thumbnail" style="width:200px;">
                        
                        <?php endif; ?>
                        <div class="form-group">
                            <?php echo Form::label('image', 'Image');; ?>

                            <div class="input-group">
                                <div class="custom-file">
                                    <?php echo Form::file('image', ['class' => 'custom-file-input', 'accept' => 'image/*']); ?>

                                    <?php echo Form::label('image', 'Image', ['class' => 'custom-file-label']);; ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo Form::submit(isset($product)?'Update!':'Submit!', ['class' => 'btn btn-primary']); ?>

                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', ['sections' => ['dashboard','Products', isset($product)?'Edit':'Create']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/products/cu.blade.php ENDPATH**/ ?>