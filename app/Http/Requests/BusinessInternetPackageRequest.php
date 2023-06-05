<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BusinessInternetPackageRequest extends FormRequest
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
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        if ($this->method() == "PUT") {
            $id = (int) $request->internet_id;
            return [
                'type' => 'required',
                'product_commercial_name_en' => 'required',
                'product_commercial_name_bn' => 'required',
                'product_short_description' => 'required',
                'activation_ussd_code' => 'required',
                'balance_check_ussd_code' => 'required',
                'data_volume' => 'required',
                'volume_data_unit' => 'required',
                'validity' => 'required',
                'validity_unit' => 'required',
                'mrp' => 'required',
                'price' => 'required',
                'banner_photo' => 'filled',
                'banner_mobile' => 'filled',
                'url_slug' => 'required|regex:/^\S*$/u|unique:business_internet_packages,url_slug,' . $id,
                'url_slug_bn' => 'required|regex:/^\S*$/u|unique:business_internet_packages,url_slug_bn,' . $id,
//                'banner_name' => 'required|regex:/^\S*$/u|unique:business_internet_packages,banner_name,' . $id,
//                'banner_name_bn' => 'required|regex:/^\S*$/u|unique:business_internet_packages,banner_name_bn,' . $id,
            ];
        } else {
            return [
                'type' => 'required',
                'product_commercial_name_en' => 'required',
                'product_commercial_name_bn' => 'required',
                'product_short_description' => 'required',
                'activation_ussd_code' => 'required',
                'balance_check_ussd_code' => 'required',
                'data_volume' => 'required',
                'volume_data_unit' => 'required',
                'validity' => 'required',
                'validity_unit' => 'required',
                'mrp' => 'required',
                'price' => 'required',
//                'banner_photo' => 'required',
//                'banner_mobile' => 'required',
                'url_slug' => 'required|regex:/^\S*$/u|unique:business_internet_packages,url_slug',
                'url_slug_bn' => 'required|regex:/^\S*$/u|unique:business_internet_packages,url_slug_bn',
//                'banner_name' => 'required|regex:/^\S*$/u|unique:business_internet_packages,banner_name',
//                'banner_name_bn' => 'required|regex:/^\S*$/u|unique:business_internet_packages,banner_name_bn',
            ];
        }
    }
}
