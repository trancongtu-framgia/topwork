<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ApplicationRequest extends FormRequest
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
            if ($role == config('app.candidate_role')) {
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
            'job_id' => 'required|numeric',
            'self_introduction' => 'nullable|max:300',
            'cv_url' => 'required|file|max:1024',
        ];
    }
}
