<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:books',
            'weight' => 'required|int',
            'size' =>['required','regex:/^\d+(\.\d{1,2})?$/'],
            'number_of_pages' => 'required|int',
            'formality' =>'required|string|max:255|min:8',
            'publication_date' => 'required|date',
            'input-file' => 'required',
            'price' =>'required|between:0,99.99',
            'describe' =>'required|string|max:10000|min:100',
        ];
    }
}
