<?php $__env->startSection('content'); ?>
<div class="container">
<?php if($errors->any()): ?>
<div class="alert alert-danger">    
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?> 
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?php echo e(trans('labels.employees.add-new-employee')); ?></h3>
            </div>
            <?php echo e(Form::open(['route' => 'employees.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-employees', 'files' => true])); ?>

                <div class="card-body">
                        <div class="form-group">
                            <?php echo $__env->make("employees.form", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="form-group form-inline">
                        <div class="edit-form-btn d-flex p-2">
                            <button type="submit" class="btn btn-primary font-weight-bold"><?php echo e(trans('buttons.create')); ?></button>
                        </div>
                        <div class="edit-form-btn d-flex p-2">
                            <a class="btn btn-danger font-weight-bold" href="<?php echo e(route('employees.index')); ?>"> <?php echo e(trans('buttons.back')); ?></a>
                        </div>
                    </div>
                </div>
           <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/GALAXYRADIXWEB/rushil.prajapati/web/rxtest/public_html/resources/views/employees/create.blade.php ENDPATH**/ ?>