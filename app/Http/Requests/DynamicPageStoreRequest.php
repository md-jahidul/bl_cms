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
            'url_slug' => 'required|regex:/^\S*$/u|unique:other_dynamic_page,url_slug,' . $this->page_id,
        ];
    }
}
