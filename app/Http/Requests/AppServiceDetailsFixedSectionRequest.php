<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AppServiceDetailsFixedSectionRequest extends FormRequest
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
        $id = (int) $request->app_service_product_details_id;
        return [
            'banner_name' => 'required|unique:app_service_product_details,banner_name,' . $id,
            'banner_name_bn' => 'required|unique:app_service_product_details,banner_name_bn,' . $id,
        ];
    }
}
