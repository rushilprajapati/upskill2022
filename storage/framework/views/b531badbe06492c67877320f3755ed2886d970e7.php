<?php $__env->startSection('content'); ?>
    <div class="container">
         <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e($message); ?></p>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e(trans('labels.employees.employees-list')); ?></h3>
                     <a class="btn btn-success" href="<?php echo e(route('employees.create')); ?>"> <?php echo e(trans('labels.employees.add-new-employee')); ?></a>
                </div>
                 <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>                                                             
                                <th><?php echo e(trans('labels.employees.firstname')); ?></th>
                                <th><?php echo e(trans('labels.employees.lastname')); ?></th>
                                <th><?php echo e(trans('labels.employees.company')); ?></th>
                                <th><?php echo e(trans('labels.employees.email')); ?></th>
                                <th><?php echo e(trans('labels.employees.phone')); ?></th>
                                <th><?php echo e(trans('labels.employees.action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$key); ?></td>
                                    <td><?php echo e($employee->firstname); ?></td>
                                    <td><?php echo e($employee->lastname); ?></td>                                    
                                    <td><?php echo e($employee['company']['name']); ?></td>
                                    <td><?php echo e($employee->email); ?></td>
                                    <td><?php echo e($employee->phone); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('employees.destroy',$employee->id)); ?>" method="POST">
                                            <a class="btn btn-primary"  href="<?php echo e(route('employees.edit',$employee->id)); ?>"><?php echo e(trans('buttons.edit')); ?></a>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button id="delete_btn" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"  type="submit" class="btn btn-danger"><?php echo e(trans('buttons.delete')); ?></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo $employees->onEachSide(5)->links(); ?>

                 </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/GALAXYRADIXWEB/rushil.prajapati/web/rxtest/public_html/resources/views/employees/index.blade.php ENDPATH**/ ?>