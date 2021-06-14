<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
      //  $id = $this->route('cart.order');
       // dd($id);

        return [

            'nameReceive' => 'required|string|max:255',
            'district' => 'required|string|max:255|not_in:0',
            'national' =>'required|string|max:255|not_in:0',
            'phoneNumber' => 'required|string|max:10|unique:users,phoneNumber,' . $this->id . ',id',
            'city' =>'required|string|max:255|not_in:0',
            'address' => 'required|string|max:255',
            'payment_online' =>'required|string|max:255',
            'book' =>'required',
            'quantity' =>'required',
            'totalPriceOrder' =>'required',
            'totalPrice' =>'required',

        ];
    }
}
