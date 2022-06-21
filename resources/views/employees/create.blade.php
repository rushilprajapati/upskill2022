@extends('layouts.app')
@section('content')
<div class="container">
@if ($errors->any())
<div class="alert alert-danger">    
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif 
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ trans('labels.employees.add-new-employee') }}</h3>
            </div>
            {{ Form::open(['route' => 'employees.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-employees', 'files' => true]) }}
                <div class="card-body">
                        <div class="form-group">
                            @include("employees.form")
                        </div>
                        <div class="form-group form-inline">
                        <div class="edit-form-btn d-flex p-2">
                            <button type="submit" class="btn btn-primary font-weight-bold">{{ trans('buttons.create') }}</button>
                        </div>
                        <div class="edit-form-btn d-flex p-2">
                            <a class="btn btn-danger font-weight-bold" href="{{ route('employees.index') }}"> {{ trans('buttons.back') }}</a>
                        </div>
                    </div>
                </div>
           {{ Form::close() }}
        </div>
    </div>
</div>
@endsection