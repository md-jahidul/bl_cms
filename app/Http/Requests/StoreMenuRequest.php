<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
//        dd($this->all());
        return [
//            'code' => 'required',
            'en_label_text' => 'required',
            'bn_label_text' => 'required',
//            'url' => 'required|unique:menus',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => "Enter menu title",
            'en_label_text.required' => "Enter menu english",
            'bn_label_text.required' => "Enter menu in Bangla",
//            'url.required' => "Enter menu url",
        ];
    }
}
