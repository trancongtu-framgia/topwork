<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'name' => 'required|min:3|unique:roles,name|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Bạn chưa nhập trường này'),
            'name.min' => __('Nhập ít nhất 3 ký tự'),
            'name.max' => __('Nhập nhỏ hơn 100 ký tự'),
            'name.unique' => __('Trường này đã tồn tại'),
        ];
    }
}
