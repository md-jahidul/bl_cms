<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
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
            'company_name' => 'required|unique:partners',
            'ceo_name' => 'required',
            'email' => 'required|email|unique:partners',
            'mobile' => 'required|unique:partners',
//            'company_logo' => 'required',
            'address' => 'required',
            'website' => 'required|unique:partners',
            'is_active' => 'required',
            'services' => 'required',
        ];
    }

    public function messages()
    {
        return [
//            'title.required' => "Enter english title",
//            'description.required' => "Enter bangla english",
//            'alt_text.required' => "Enter alt ext",
//            'url_btn_label.required' => "Enter button url",
//            'redirect_url.required' => "Enter redirect url",
        ];
    }
}
