<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExploreCRequest extends FormRequest
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
        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            
            return [
                'title_en' => 'required',
                'title_bn' => 'required',
                'slug_en' => 'required|unique:explore_c_s,slug_en,' . $id['explore_c'],
                'slug_bn' => 'required|unique:explore_c_s,slug_bn,' . $id['explore_c'],
                'image'    => 'mimes:jpeg,jpg,png'
            ];
        } else {
            return [
                'title_en' => 'required',
                'title_bn' => 'required',
                'slug_en' => 'required|unique:explore_c_s,slug_en',
                'slug_bn' => 'required|unique:explore_c_s,slug_bn',
                'image'    => 'mimes:jpeg,jpg,png'
            ];
        }
        
    }

    public function messages()
    {
        return [
            'title_en.required' => "Enter explore c's title",
        ];
    }
}
