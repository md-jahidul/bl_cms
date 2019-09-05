<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortCutStoreRequest extends FormRequest
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
            'tittle' => 'required|unique:shortcuts|max:10',
            'icon' => 'required|image|mimes:jpeg,jpg,png'
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
