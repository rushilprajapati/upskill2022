<div class="box-body">
    <div class="form-group">
        <?php echo e(Form::label('Firstname', trans('labels.employees.firstname'), ['class' => 'col-lg-2 control-label required'])); ?>

        <div class="col-lg-10">
        <?php echo e(Form::text('firstname', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.employees.firstname')])); ?>

        </div>
    </div>
    <div class="form-group">
        <?php echo e(Form::label('Lastname', trans('labels.employees.lastname'), ['class' => 'col-lg-2 control-label required'])); ?>

        <div class="col-lg-10">
        <?php echo e(Form::text('lastname', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.employees.lastname')])); ?>

        </div>
    </div>
    <div class="form-group">
        <?php echo e(Form::label('Company', trans('labels.employees.company-list'), ['class' => 'col-lg-2 control-label required'])); ?>

        <div class="col-lg-10">
        <?php echo Form::select('company_id', $companies, null, ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="form-group">
        <?php echo e(Form::label('email', trans('labels.employees.email'), ['class' => 'col-lg-2 control-label required'])); ?>

        <div class="col-lg-10">
        <?php echo e(Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.employees.email')])); ?>

        </div>
    </div>
    <div class="form-group">
        <?php echo e(Form::label('phone', trans('labels.employees.phone'), ['class' => 'col-lg-2 control-label required'])); ?>

        <div class="col-lg-10">
        <?php echo e(Form::text('phone', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.employees.phone')])); ?>

        </div>
    </div>
</div><?php /**PATH /home/GALAXYRADIXWEB/rushil.prajapati/web/rxtest/public_html/resources/views/employees/form.blade.php ENDPATH**/ ?>