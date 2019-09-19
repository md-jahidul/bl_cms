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
            'en_title' => 'required',
            'bn_title' => 'required',
            'image_url' => 'required|mimes:png,jpeg',
            'alt_text' => 'required',
            'link' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'en_title.required' => "Enter english title",
            'bn_title.required' => "Enter bangla english",
            'alt_text.required' => "Enter alt ext",
            'link.required' => "Enter link",
            'status.required' => "Please checked status",
        ];
    }
}
