<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
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
            'name' => 'required',
            'user_name' => 'required|min:3|unique:users,user_name',
            'email' => 'required|min:3|unique:users,email',
            'password' => 'required|between:6,20|alpha_num',
            'password_confirm' => 'required_with:password|same:password',
            'phone' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'dob' => 'required',
        ];
    }
}
