<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BusinessOtherPackageRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $id = (int) $request->service_id;
        return [
            'type' => 'required',
            'name_en' => 'required',
            'name_bn' => 'required',
            'short_details_en' => 'required',
            'short_details_bn' => 'required',
            'url_slug' => 'required|regex:/^\S*$/u|unique:business_other_services,url_slug,' . $id,
            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:business_other_services,url_slug_bn,' . $id,
            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:business_other_services,url_slug_bn,' . $id,
            'banner_name' => 'required|regex:/^\S*$/u|unique:business_other_services,banner_name,' . $id,
            'banner_name_bn' => 'nullable|regex:/^\S*$/u|unique:business_other_services,banner_name_bn,' . $id,
            'details_banner_name' => 'nullable|regex:/^\S*$/u|unique:business_other_services,details_banner_name,' . $id,
            'details_banner_name_bn' => 'nullable|regex:/^\S*$/u|unique:business_other_services,details_banner_name,' . $id,
        ];
    }
}
