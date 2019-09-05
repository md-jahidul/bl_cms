<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortCutUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'tittle' => 'unique:shortcuts|max:10',
            'icon' => 'image|mimes:jpeg,jpg,png'
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            
        ];
    }
}
