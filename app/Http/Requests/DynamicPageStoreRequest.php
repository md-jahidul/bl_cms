<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DynamicPageStoreRequest extends FormRequest
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
            'page_name_en' => 'required',
            'page_name_bn' => 'required',
            'banner_name' => 'required|unique:other_dynamic_page,banner_name,' . $this->page_id,
            'banner_name_bn' => 'required|unique:other_dynamic_page,banner_name_bn,' . $this->page_id,
            'url_slug' => 'required|regex:/^\S*$/u|unique:other_dynamic_page,url_slug,' . $this->page_id,
            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:other_dynamic_page,url_slug_bn,' . $this->page_id,
        ];
    }
}
