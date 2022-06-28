<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Http\Requests\Comapnies\StoreRequest;
use App\Repositories\Companies\CompaniesRepositories;
use App\Http\Requests\Comapnies\UpdateCompaniesRequest;
use App\Http\Controllers\HomeController;

class CompaniesController extends Controller
{
    /**
     * @var CompaniesRepositories
     */
    protected $companies;

    /**
     * @param \App\Repositories\Companies\CompaniesRepositories $companies
     */
    public function __construct(CompaniesRepositories $companies)
    {
        $this->companies = $companies;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $companies = $this->companies->getForDataTable();        
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, HomeController $home)
    {
        $input = $request->all();
        $this->companies->create($input);
        // Call the Push Notification Method
        $getFirebaseReponse = json_decode($home->sendPushNotification());
        if (!empty($getFirebaseReponse) && $getFirebaseReponse->success == true) {
            return redirect()->route('companies.index')->with('success', 'Companies created successfully - ' . 'Firebase Success ID : ' . $getFirebaseReponse->message_id);
        } else {
            return redirect()->route('companies.index')->with('success', 'Companies created successfully - ' . 'Firebase Error : ' . $getFirebaseReponse->error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies, $id)
    {
		$companies = $companies->find($id);
        return view('companies.edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompaniesRequest $request,$companies)
    {
        
        $companies = Companies::find($companies);
        $input = $request->except('_token','_method');
        $update = $this->companies->update($input,$companies);
        return redirect()->route('companies.index')->with('success','Companies updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Companies $companies)
    {
        $companies->where('id', $id)->delete();
        return redirect()->route('companies.index')->with('success','Companies deleted successfully');
    }
}
