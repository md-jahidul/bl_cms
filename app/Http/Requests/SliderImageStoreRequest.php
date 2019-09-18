<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderImageStoreRequest extends FormRequest
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
            'repeater-list.*.slider_id'=>'',
            'repeater-list.*.title'=>'required',
            'repeater-list.*.description'=>'',
            'repeater-list.*.image_url'=>'required|image|mimes:jpeg,jpg,png|dimensions:ratio=16/9',
            'repeater-list.*.alt_text'=>'',
            'repeater-list.*.url_btn_label'=>'',
            'repeater-list.*.url'=>'',
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
            'repeater-list.*.image_url.dimensions' => 'Slider Image is Mast be in 16:9 dimension',
            'repeater-list.*.image_url.required' => 'Slider Image is required',
            'repeater-list.*.title.required' => 'title is required',
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
