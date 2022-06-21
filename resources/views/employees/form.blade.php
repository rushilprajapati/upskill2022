<div class="box-body">
    <div class="form-group">
        {{ Form::label('Firstname', trans('labels.employees.firstname'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {{ Form::text('firstname', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.employees.firstname')]) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('Lastname', trans('labels.employees.lastname'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {{ Form::text('lastname', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.employees.lastname')]) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('Company', trans('labels.employees.company-list'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {!! Form::select('company_id', $companies, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('email', trans('labels.employees.email'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {{ Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.employees.email')]) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('phone', trans('labels.employees.phone'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        {{ Form::text('phone', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.employees.phone')]) }}
        </div>
    </div>
</div>