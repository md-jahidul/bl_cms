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
        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'app_service_tab_id' => 'required',
                'app_service_cat_id' => 'required',
                'url_slug' => 'required|unique:app_service_products,url_slug,' . $id['app_service_product'],
                'url_slug_bn' => 'required|unique:app_service_products,url_slug_bn,' . $id['app_service_product']
            ];
        } else {
            return [
                'app_service_tab_id' => 'required',
                'app_service_cat_id' => 'required',
                'url_slug' => 'required|unique:app_service_products,url_slug',
                'url_slug_bn' => 'required|unique:app_service_products,url_slug_bn'
            ];
        }
    }
}
