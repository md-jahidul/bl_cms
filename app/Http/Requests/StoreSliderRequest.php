<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
            'title' => 'required|max:200',
            'component_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Enter slider title",
            'slider_type_id.required' => 'Select slider type'
        ];
    }
}
