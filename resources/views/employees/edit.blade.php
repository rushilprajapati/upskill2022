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
                    {{ Form::model($employees, ['route' => ['employees.update', $employees], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}
                        <div class="card-body">
                            <div class="form-group">
                                @include("employees.form")
                            </div>
                            <div class="form-group form-inline">
                                <div class="edit-form-btn d-flex p-2">
                                    <button type="submit" class="btn btn-primary">{{ trans('buttons.edit') }}</button>
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