<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderImageRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'image_url' => 'required|mimes:png,jpeg',
            'alt_text' => 'required',
            'url_btn_label' => 'required',
            'redirect_url' => 'required',
            'is_active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Enter english title",
            'description.required' => "Enter bangla english",
            'alt_text.required' => "Enter alt ext",
            'url_btn_label.required' => "Enter button url",
            'redirect_url.required' => "Enter redirect url",
        ];
    }
}
