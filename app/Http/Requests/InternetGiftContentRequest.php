<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternetGiftContentRequest extends FormRequest
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
            'name_en' => 'required',
            'name_bn' => 'required',
            'icon'   => 'mimes:jpeg,jpg,png,gif|max:3000',
            'banner'   => 'mimes:jpeg,jpg,png,gif|max:3000'
        ];
    }
}
