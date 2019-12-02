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
            'partner_category_id' => 'required',
            'company_name_en' => 'required|unique:partners,company_name_en,' . $this->partner,
            'company_name_bn' => 'required|unique:partners,company_name_bn,' . $this->partner,
            'company_logo' => 'file|mimes:jpeg,jpg,png',
            'company_address' => 'required',
            'company_website' => 'required|url|unique:partners,company_website,' . $this->partner,
            'contact_person_name' => 'required',
            'contact_person_email' => 'required|email|unique:partners,contact_person_email,' . $this->partner,
            'contact_person_mobile' => 'required|unique:partners,contact_person_mobile,' . $this->partner,
        ];
    }

    public function messages()
    {
        return [
            'partner_category_id.required' => "The partner category field is required.",
        ];
    }
}
