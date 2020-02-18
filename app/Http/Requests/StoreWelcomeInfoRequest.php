<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWelcomeInfoRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,jpg,png|dimensions:ratio=8/3',
            'message_en' => 'required|max:150',
            'message_bn' => 'required|max:150',
            'login_button_title' => 'required|max:30'
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
            'image.dimensions' => 'Image is Must be in 8:3 dimension'
        ];
    }
}
