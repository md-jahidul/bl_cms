<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyblAppMenuRequest extends FormRequest
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
            'title_en' => 'required',
            'title_bn' => 'required',
            'status' => 'required',
            'android_version_code' => 'nullable|regex:/^\d+-\d+$/',
            'ios_version_code' => 'nullable|regex:/^\d+-\d+$/',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => "Enter menu english",
            'title_bn.required' => "Enter menu in Bangla",
        ];
    }
}
