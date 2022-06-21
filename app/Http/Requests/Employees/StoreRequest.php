<?php

namespace App\Http\Requests\Employees;

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
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'company_id' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ];
    }
    /**
     * Custom Error Message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required'  => 'The First Name field is required!',
            'lastname.required' => 'The Last Name field is required!',
            'company_id.image' => 'The Last Company List field is required!',
            'email.required' => 'The Email field is required!',
            'phone.required' => 'The Phone field is required!',
        ];
    }
}
