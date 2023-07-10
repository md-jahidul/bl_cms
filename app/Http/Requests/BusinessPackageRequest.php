<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BusinessPackageRequest extends FormRequest
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
        if ($this->method() == "PUT") {
            $id = (int) $request->package_id;
            return [
                'name_en' => 'required',
                'name_bn' => 'required',
                'short_details_en' => 'required',
                'short_details_bn' => 'required',
                'url_slug' => 'required|regex:/^\S*$/u|unique:business_packages,url_slug,' . $id,
                'url_slug_bn' => 'required|regex:/^\S*$/u|unique:business_packages,url_slug_bn,' . $id,
//                'banner_name' => 'required|regex:/^\S*$/u',
            ];
        } else {
            return [
                'name_en' => 'required',
                'name_bn' => 'required',
                'short_details_en' => 'required',
                'short_details_bn' => 'required',
//                'banner_photo' => 'required|mimes:jpg,jpeg,png',
                'url_slug' => 'required|regex:/^\S*$/u|unique:business_packages,url_slug',
                'url_slug_bn' => 'required|regex:/^\S*$/u|unique:business_packages,url_slug_bn',
//                'banner_name' => 'required|regex:/^\S*$/u',
            ];
        }
    }
}
