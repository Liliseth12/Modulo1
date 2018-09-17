<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeEditRequest extends FormRequest
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
        'email'=>'email',
        'phonenumber'=>'alpha_dash',
        'date'=>'date'
        ];
    }
}
