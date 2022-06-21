<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Http\Requests\Employees\StoreRequest;
use App\Repositories\Employees\EmployeesRepositories;
use App\Http\Requests\Employees\UpdateEmployeesRequest;

class EmployeesController extends Controller
{
    /**
     * @var EmployeesRepositories
     */
    protected $employees;

    /**
     * @param \App\Repositories\Employees\EmployeesRepositories $employees
     */
    public function __construct(EmployeesRepositories $employees)
    {
        $this->employees = $employees;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employees->getForDataTable();        
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Companies::pluck('name','id');        
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $input = $request->all();
        $createEmployees = $this->employees->create($input);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employees, $id)
    {
        $employees = $employees->find($id);
        $companies = Companies::pluck('name','id');       
        return view('employees.edit', compact('employees','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeesRequest $request,$employees)
    {
        
        $input = $request->except('_token','_method');
        $update = $this->employees->update($input,$employees);
        return redirect()->route('employees.index')->with('success','Employees updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Employees $employees)
    {
        $employees->where('id', $id)->delete();
        return redirect()->route('employees.index')->with('success','Employees deleted successfully');
    }
}
