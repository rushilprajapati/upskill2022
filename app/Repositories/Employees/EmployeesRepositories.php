<?php

namespace App\Repositories\Employees;
use App\Repositories\BaseRepository;
use App\Models\Employees;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\GeneralException;

/**
 * Class EmployeesRepositories.
 */
class EmployeesRepositories extends BaseRepository
{
    /**
     * Upload Path
     */
    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    /**
     * Construct the path
     */
    public function __construct()
    {
        //
    }

    /**
     * Get Data For Employees.
    * 
    * @return array $Employees.      
    */
    public function getForDataTable()
    {
        $Employees = Employees::with('company')->orderBy('id','desc')->simplePaginate(5);
        return $Employees;
    }

    /**
     * Create Employees.
    * 
    * @param array $input.
    * @return bool.
    */
    public function create($input) 
    {         
        Employees::create($input);
    }
    public function update($input,$id)
    {
        $employees = Employees::where('id',$id)->update($input);
        if ($employees) {
            return true;
        }
         throw new GeneralException(trans('Something went wrong!'));
    }

}