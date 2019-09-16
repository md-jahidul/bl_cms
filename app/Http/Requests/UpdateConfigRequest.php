<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigRequest extends FormRequest
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
            "site_url" => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required|numeric',
            'other_info' => 'required',
            'copy_right' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
        ];
    }

    public function messages() {
        return [
            'site_url.required' => "Can't be save null value",
            'email.required' => "Can\'t be save null value",
            'mobile_number.required' => "Can\'t be save null value",
            'other_info.required' => "Can\'t be save null value",
            'copy_right.required' => "Can\'t be save null value",
            'facebook.required' => "Can\'t be save null value",
            'twitter.required' => "Can\'t be save null value",
            'linkedin.required' => "Can\'t be save null value",
        ];
    }
}
