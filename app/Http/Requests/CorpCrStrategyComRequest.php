<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CorpCrStrategyComRequest extends FormRequest
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
            'image_name_en' => 'required|unique:corp_cr_strategy_components,image_name_en,' . $this->id,
            'image_name_bn' => 'required|unique:corp_cr_strategy_components,image_name_bn,' . $this->id,
            'url_slug_en' => 'required|unique:corp_cr_strategy_components,url_slug_en,' . $this->id,
            'url_slug_bn' => 'required|unique:corp_cr_strategy_components,url_slug_bn,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'image_name_en.required' => "Enter image name in english",
            'image_name_bn.required' => "Enter image name in Bangla",
        ];
    }
}
