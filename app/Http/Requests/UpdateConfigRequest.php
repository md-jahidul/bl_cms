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
//            "site_logo" => 'required',
            "logo_alt_text" => 'required',
            'email' => 'required|email',
            'query_email' => 'required|email',
            'mobile_number_EN' => 'required|numeric',
            'mobile_number_BN' => 'required',
            'address_EN' => 'required',
            'address_BN' => 'required',
            'copy_right_EN' => 'required',
            'copy_right_BN' => 'required',
            'google_play_link' => 'required|url',
            'apple_app_store_link' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
//            'site_logo.required' => "Can't be save null value",
//            'email.required' => "Can\'t be save null value",
//            'mobile_number.required' => "Can\'t be save null value",
//            'address.required' => "Can\'t be save null value",
//            'copy_right.required' => "Can\'t be save null value",
//            'facebook.required' => "Can\'t be save null value",
//            'twitter.required' => "Can\'t be save null value",
//            'linked

        ];
    }
}
