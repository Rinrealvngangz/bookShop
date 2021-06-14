<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSalesOrderRequest extends FormRequest
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
            'nameReceive' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'national' =>'required|string|max:255',
            'phoneNumber' => 'required|string|max:10|unique:users,phoneNumber,' .  Auth::user()->id . ',id',
            'city' =>'required|string|max:255',
            'address' => 'required|string|max:255'
        ];
    }
}
