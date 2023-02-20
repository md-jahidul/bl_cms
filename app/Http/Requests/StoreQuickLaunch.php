<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuickLaunch extends FormRequest
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
            'title_en' => 'required',
            'title_bn' => 'required',
            'image_url' => 'required|mimes:png,jpeg,svg',
            'alt_text' => 'required',
            'link' => 'required',
            'link_bn' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'en_title.required' => "Enter title in English",
            'bn_title.required' => "Enter title in Bangla",
            'alt_text.required' => "Enter alt ext",
            'link.required' => "Enter link",
            'status.required' => "Please checked status",
        ];
    }
}
