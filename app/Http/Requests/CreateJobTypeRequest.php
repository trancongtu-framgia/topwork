<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobTypeRequest extends FormRequest
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
            'name'=> 'required|min:3|unique:job_types,name|max:100'. $this->id . ',id,deleted_at,NULL',
            'description' => 'min:3|max:200',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => __('Bạn chưa nhập loại công việc'),
            'name.min' => __('Loại công việc ít nhất 3 ký tự'),
            'name.max' => __('Loại công việc nhỏ hơn 100 ký tự'),
            'description.min' => __('Ghi chú phải lớn hơn 3 ký tự'),
            'description.max' => __('Ghi chú phải nhỏ hơn 200 ký tự'),
            'name.unique' => __('Loại công việc này đã tồn tại'),
        ];
    }
}
