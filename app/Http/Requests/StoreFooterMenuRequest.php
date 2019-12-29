<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFooterMenuRequest extends FormRequest
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
            'code' => 'required',
            'en_label_text' => 'required',
            'bn_label_text' => 'required',
            'url' => 'required|unique:footer_menus',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Enter footer menu title",
            'en_label_text.required' => "Enter footer menu english",
            'bn_label_text.required' => "Enter footer menu in Bangla",
            'url.required' => "Enter footer menu url",
        ];
    }
}
