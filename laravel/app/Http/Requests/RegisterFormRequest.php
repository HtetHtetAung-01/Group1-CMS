<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'name'             => 'required',
            'photo'            =>'required',
            'email'            => 'required|email|unique:users',
            'password'         => 'min:6',
            'confirm_password' => 'min:6|required_with:password|same:password',
            'date_of_birth'    =>'required',
            'gender'           => 'required',
            'role_type'        =>'required',
            'address'          =>'required',
            'phone_number'     =>'required|min:11|numeric',  
        ];
    }
}
