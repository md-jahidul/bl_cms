<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderImageUpdateRequest extends FormRequest
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
            'slider_id'=>'',
            'title'=>'required',
            'description'=>'',
            'image_url'=>'image|mimes:jpeg,jpg,png|dimensions:ratio=16/9',
            'alt_text'=>'',
            'url_btn_label'=>'',
            'url'=>'',
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
            'dimensions' => 'Slider Image is Mast be in 16:9 dimension',
            'required' => 'Slider Image is required',
            'required' => 'title is required',
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    // public function filters()
    // {
    //     return [
    //         'email' => 'trim|lowercase',
    //         'name' => 'trim|capitalize|escape'
    //     ];
    // }
}
