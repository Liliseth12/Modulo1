<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'firstname'=>'alpha|required|min:2|max:25',
            'lastname'=>'alpha|required|min:2|max:25',
            'email'=>'email|unique:employees',
            'ci'=>'unique:employees',
            'phonenumber'=>'alpha_dash',
            'date'=>'date',
            'position_name'=>'max:60',
            'amount'=>'required'
        ];
    }
}
