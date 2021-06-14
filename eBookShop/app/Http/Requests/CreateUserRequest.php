<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'firstName'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'address'=>'required|string|min:8',
            'phoneNumber'=>'required|string|min:10',
            'userName'=>'required|string|max:255',
            'email'=>'required|regex:/(.+)@(.+)\.(.+)/i|email|unique:users',
           'password' => 'required|between:8,255|confirmed',


        ];
    }
}
