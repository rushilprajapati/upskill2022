<?php

namespace App\Http\Requests\Comapnies;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->hasFile('image')) {
            return [
                'name' => 'required',
                'email' => 'required|unique:companies',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|min:100|max:5000',
                'website' => 'required'
             ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|unique:companies',        
                'website' => 'required'
            ];
        }
        
    }
    /**
     * Custom Error Message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'  => 'The comanies name field is required!',
            'email.required' => 'The email field is required!',
            'email.unique' => 'The email has already been taken!',
            'image.image'    => 'Please provide valid image!',
            'website.required' => 'The website field is required!' 
        ];
    }
}
