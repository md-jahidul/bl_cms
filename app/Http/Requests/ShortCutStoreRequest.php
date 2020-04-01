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
        $rules = [
            'title' => 'required|max:200|unique:shortcuts,title,' . $this->id,
            'icon' => 'required_if:value_exist,no|image|mimes:jpeg,jpg,png'
        ];

        if ($this->component_identifier == "URL") {
            $rules ['other_info'] = 'required|url';
        }

        if ($this->component_identifier == "DIAL") {
            $rules ['other_info'] = 'required';
        }

        return $rules;
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'other_info' => 'Number/ URL',
        ];
    }
}
