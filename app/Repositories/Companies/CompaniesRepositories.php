<?php

namespace App\Repositories\Companies;
use App\Repositories\BaseRepository;
use App\Models\Companies;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Storage;
/**
 * Class CompaniesRepositories.
 */
class CompaniesRepositories extends BaseRepository
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
	 	$this->upload_path = 'images';
	 	$this->storage = Storage::disk('public');
	 }
	 /**
	  * Get Data For Companies.
	  * 
	  * @return array $companies.      
      */
     public function getForDataTable()
     {
     	$companies = Companies::orderBy('id','desc')->simplePaginate(5);
     	return $companies;
     }
     /**
      * Create Companies.
      * 
      * @param array $input.
      * @return bool.
      */
     public function create($input) 
     {     	 
         if (isset($input['image'])) {            
           $path = $input['image']->store('public/images');
           $fileName = time().'.'.$input['image']->extension();  
           $upload =  $input['image']->storeAs('',$fileName);
           $input['logo'] = $fileName;
        }
        if (Companies::create($input)) {
        	return true;	
        }
        throw new GeneralException(trans('Something went wrong!'));
     }
     /**
      * Update Companies.
      *
      * @param array $input.
      * @return bools.
      */
     public function update($input,$companies) 
     {
     	if (isset($input['image'])) {            
           $path = $input['image']->store('public/images');
           $fileName = time().'.'.$input['image']->extension();  
           $upload =  $input['image']->storeAs('',$fileName);
           $input['logo'] = $fileName;
        }
        $update = $companies->update($input);
        if ($update) {
        	return true;
        }
        throw new GeneralException(trans('Something went wrong!'));
     }

}