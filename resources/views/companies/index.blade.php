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
                    <h3 class="card-title">{{ trans('labels.companies.company-list') }}</h3>
                     <a class="btn btn-success" href="{{ route('companies.create') }}"> {{ trans('labels.companies.add-new-company') }}</a>
                </div>
                 <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                 <th style="width: 10px">#</th>                                                             
                                 <th>{{ trans('labels.companies.name') }}</th>
                                 <th>{{ trans('labels.companies.email') }}</th>
                                 <th>{{ trans('labels.companies.logo') }}</th>
                                 <th>{{ trans('labels.companies.website') }}</th>
                                 <th>{{ trans('labels.companies.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($companies as $key => $company)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td><img src="{{ url('public/storage/images/'.$company->logo) }}" width="100px"></td>
                                    <td>{{ $company->website }}</td>
                                    <td>
                                        <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
                                            <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">{{ trans('buttons.edit') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-danger">{{ trans('buttons.delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                   
                    {!! $companies->onEachSide(5)->links() !!}
                 </div>                 
            </div>            
        </div>        
    </div>

@endsection