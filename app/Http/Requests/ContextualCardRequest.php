<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContextualCardRequest extends FormRequest
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
            'title' => 'required|max:200|unique:contextual_cards,title,' . $this->id,
            'description' => 'required',
            'first_action_text' => 'required',
            'second_action_text' => 'required',
            'first_action' => 'required',
            'second_action' => 'required',
            'image_url' => 'required_if:value_exist,no|image|mimes:jpeg,jpg,png|dimensions:ratio=1/1'
        ];
    }

    public function messages()
    {
        return [
            'image_url.dimensions' => 'Image dimension must be in 1:1',
        ];
    }
}
