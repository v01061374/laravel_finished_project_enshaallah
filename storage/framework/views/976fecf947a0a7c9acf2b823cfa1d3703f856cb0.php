<?php $__env->startSection('title'); ?>
    <?php if(isset($purchase)): ?>
        Purchases - Edit
    <?php else: ?>
        Purchases - Create
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

                        <?php echo Form::open( ['route' => [isset($purchase)?'purchases.update':'purchases.store', isset($purchase)?$p_id:''], 'files' => true]); ?>

                        <div class="form-group">
                            <?php echo Form::label('', 'Products');; ?>

                            <div id="inline-products">
                                <table id="inline-products-table">
                                    <tbody>
                                    
                                            <?php if(isset($purchase) && count($purchase['products'])): ?>
                                                <?php $__currentLoopData = $purchase['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="inline-product-record">

                                                        <?php if(1==0 && $product['pivot']['stocked']): ?>
                                                            
                                                            <td>
                                                                <?php echo Form::select('product_id[]',$products,\App\CustomClasses\Hasher::encode($product['id']),['required'=>'required', 'class' => 'form-control select2', 'placeholder' => 'Search Product Title', 'disabled' => "true"]); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo Form::number('qty[]',$product->pivot->qty,[ 'class' => 'form-control', 'placeholder' => 'Quantity', 'min' => 1, 'required' => 'required' , 'disabled' => "true"]); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo Form::number('price[]',$product->pivot->unit_price,[ 'class' => 'form-control', 'placeholder' => 'Price (Rial)', 'min' => 1, 'required' => 'required' , 'disabled' => "true"]); ?>

                                                            </td>
                                                        <?php else: ?>
                                                            <td>
                                                                <?php echo Form::select('product_id[]',$products,\App\CustomClasses\Hasher::encode($product['id']),['required'=>'required', 'class' => 'form-control select2', 'placeholder' => 'Search Product Title']); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo Form::number('qty[]',$product->pivot->qty,[ 'class' => 'form-control', 'placeholder' => 'Quantity', 'min' => 1, 'required' => 'required' ]); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo Form::number('price[]',$product->pivot->unit_price,[ 'class' => 'form-control', 'placeholder' => 'Price (Rial)', 'min' => 1, 'required' => 'required' ]); ?>

                                                            </td>
                                                        <?php endif; ?>
                                                        <td>
                                                            <i title="Add New" class="inline-product-add fas fa-plus-circle" style="color:green; margin-left: 5px; cursor: pointer;"></i>
                                                        </td>
                                                        <td>
                                                            <i title="Remove" class="inline-product-remove fas fa-times-circle" style="color:red; margin-left: 5px; cursor: pointer;"></i>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php elseif(isset($purchase) && !count($purchase['products'])): ?>
                                                <tr class="inline-product-record">

                                                    <td>
                                                    <?php echo Form::select('product_id[]',$products,'',['required'=>'required', 'class' => 'form-control select2', 'placeholder' => 'Search Product Title']); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo Form::number('qty[]','',[ 'class' => 'form-control', 'placeholder' => 'Quantity', 'min' => 1, 'required' => 'required' ]); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo Form::number('price[]','',[ 'class' => 'form-control', 'placeholder' => 'Price (Rial)', 'min' => 1, 'required' => 'required' ]); ?>

                                                    </td>
                                                    <td>
                                                        <i title="Add New" class="inline-product-add fas fa-plus-circle" style="color:green; margin-left: 5px; cursor: pointer;"></i>
                                                    </td>
                                                    <td>
                                                        <i title="Remove" class="inline-product-remove fas fa-times-circle" style="color:red; margin-left: 5px; cursor: pointer;"></i>
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <tr class="inline-product-record">
                                                    <td>
                                                    <?php echo Form::select('product_id[]',$products,'',['required'=>'required', 'class' => 'form-control select2', 'placeholder' => 'Search Product Title']); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo Form::number('qty[]','',[ 'class' => 'form-control', 'placeholder' => 'Quantity', 'min' => 1, 'required' => 'required' ]); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo Form::number('price[]','',[ 'class' => 'form-control', 'placeholder' => 'Price (Rial)', 'min' => 1, 'required' => 'required' ]); ?>

                                                    </td>
                                                    <td>
                                                        <i title="Add New" class="inline-product-add fas fa-plus-circle" style="color:green; margin-left: 5px; cursor: pointer;"></i>
                                                    </td>
                                                    <td>
                                                        <i title="Remove" class="inline-product-remove fas fa-times-circle" style="color:red; margin-left: 5px; cursor: pointer;"></i>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo Form::label('date', 'Date');; ?>

                            <?php echo Form::date('date',isset($purchase)?$purchase['date']:'',['required'=>'required', 'class' => 'form-control', 'placeholder' => 'date' ]); ?>

                        </div>
                        <div class="form-group">
                                <?php echo Form::label('side_costs', 'Side Costs (Rial)');; ?>

                            <?php echo Form::number('side_costs',isset($purchase)?$purchase['side_costs']:'',[ 'class' => 'form-control', 'placeholder' => 'Side Costs (Rial)', 'min' => 0 ]); ?>

                        </div>
                        <div class="form-group">
                            <?php echo Form::label('supplier_id', 'Supplier');; ?>

                            <?php echo Form::select('supplier_id',$suppliers,isset($purchase)?\App\CustomClasses\Hasher::encode($purchase['supplier_id']):'',['required'=>'required', 'class' => 'form-control']); ?>

                        </div>


                        <div class="form-group">
                            <?php echo Form::submit(isset($purchase)?'Update!':'Submit!', ['class' => 'btn btn-primary']); ?>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->





<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var wrapper = $('#inline-products-table');
        var recordHtml = $('.inline-product-record').get(0).outerHTML;
        $(document).ready(function () {
            $(document).on('click','.inline-product-add',function () {
                wrapper.append(recordHtml);

                // TODO change css of remaining remove button
            });
            $(document).on('click', '.inline-product-remove', function () {
                if($('.inline-product-record').length-1){
                    this.closest('.inline-product-record').remove();
                }
            })
            $('.select2').select2({

            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.master', ['sections' => ['dashboard','Purchases', isset($purchase)?'Edit':'Create']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\laravel_finished_project_enshaallah\resources\views/dashboard/purchases/cu.blade.php ENDPATH**/ ?>