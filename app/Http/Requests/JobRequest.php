<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check() == false) {
            return redirect()->route('login');
        } else {
            $role = Auth::user()->userRole->name;
            if ($role == config('app.company_role')) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:4|max:100',
            'salary_min' => 'required|numeric',
            'salary_max' => 'required|numeric',
            'description' => 'required',
            'location_id' => 'required|numeric',
            'job_type_id' => 'required|numeric',
            'out_date' => 'required|date',
            'experience' => 'required|min:3|max:100',
            'category_ids' => 'required|array',
            'job_skill_ids' => 'required',
        ];
    }
}
