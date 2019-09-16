<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HelpCenterRequest extends FormRequest
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
            'value_exist'=>'required',
            'title'=>'required',
            'icon'=>'required_if:value_exist,no|image|mimes:jpeg,jpg,png',
            'redirect_link'=>'required',
            'sequence'=>'required|numeric|min:0|unique:help_centers',
        ];
    }
}
