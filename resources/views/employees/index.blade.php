@extends('layouts.app')
@section('content')
    <div class="container">
         @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('labels.employees.employees-list') }}</h3>
                     <a class="btn btn-success" href="{{ route('employees.create') }}"> {{ trans('labels.employees.add-new-employee') }}</a>
                </div>
                 <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>                                                             
                                <th>{{ trans('labels.employees.firstname') }}</th>
                                <th>{{ trans('labels.employees.lastname') }}</th>
                                <th>{{ trans('labels.employees.company') }}</th>
                                <th>{{ trans('labels.employees.email') }}</th>
                                <th>{{ trans('labels.employees.phone') }}</th>
                                <th>{{ trans('labels.employees.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($employees as $key => $employee)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $employee->firstname }}</td>
                                    <td>{{ $employee->lastname }}</td>                                    
                                    <td>{{ $employee['company']['name'] }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                                            <a class="btn btn-primary"  href="{{ route('employees.edit',$employee->id) }}">{{ trans('buttons.edit') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <button id="delete_btn" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"  type="submit" class="btn btn-danger">{{ trans('buttons.delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $employees->onEachSide(5)->links() !!}
                 </div>
            </div>
        </div>
    </div>
@endsection

