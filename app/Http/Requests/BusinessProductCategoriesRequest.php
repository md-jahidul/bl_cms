<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BusinessProductCategoriesRequest extends FormRequest
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
        return [
            'url_slug' => 'required|unique:business_product_categories,url_slug,' . $request->cat_id,
            'url_slug_bn' => 'required|unique:business_product_categories,url_slug_bn,' . $request->cat_id,
            'banner_name' => 'nullable|unique:business_product_categories,banner_name,' . $request->cat_id,
            'banner_name_bn' => 'nullable|unique:business_product_categories,banner_name_bn,' . $request->cat_id,
        ];
    }
}
