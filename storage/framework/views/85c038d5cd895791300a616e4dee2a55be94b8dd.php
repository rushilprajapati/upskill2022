  
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
                    <h3 class="card-title"><?php echo e(trans('labels.companies.company-list')); ?></h3>
                     <a class="btn btn-success" href="<?php echo e(route('companies.create')); ?>"> <?php echo e(trans('labels.companies.add-new-company')); ?></a>
                </div>
                 <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                 <th style="width: 10px">#</th>                                                             
                                 <th><?php echo e(trans('labels.companies.name')); ?></th>
                                 <th><?php echo e(trans('labels.companies.email')); ?></th>
                                 <th><?php echo e(trans('labels.companies.logo')); ?></th>
                                 <th><?php echo e(trans('labels.companies.website')); ?></th>
                                 <th><?php echo e(trans('labels.companies.action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$key); ?></td>
                                    <td><?php echo e($company->name); ?></td>
                                    <td><?php echo e($company->email); ?></td>
                                    <td><img src="<?php echo e(url('public/storage/images/'.$company->logo)); ?>" width="100px"></td>
                                    <td><?php echo e($company->website); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('companies.destroy',$company->id)); ?>" method="POST">
                                            <a class="btn btn-primary" href="<?php echo e(route('companies.edit',$company->id)); ?>"><?php echo e(trans('buttons.edit')); ?></a>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-danger"><?php echo e(trans('buttons.delete')); ?></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>                   
                    <?php echo $companies->onEachSide(5)->links(); ?>

                 </div>                 
            </div>            
        </div>        
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/GALAXYRADIXWEB/rushil.prajapati/web/rxtest/public_html/resources/views/companies/index.blade.php ENDPATH**/ ?>