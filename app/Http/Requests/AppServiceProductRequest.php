<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppServiceProductRequest extends FormRequest
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
        $id = $this->route()->parameters() ? $this->route()->parameters()['app_service_product'] : '';
        return [
            'product_img_en' => 'unique:app_service_products,product_img_en,' . $id,
            'product_img_bn' => 'unique:app_service_products,product_img_bn,' . $id,
            'url_slug' => 'required|unique:app_service_products,url_slug,' . $id,
            'url_slug_bn' => 'required|unique:app_service_products,url_slug_bn,' . $id
        ];
    }
}
