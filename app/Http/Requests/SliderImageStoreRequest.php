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
            'slider_id' => '',
            'title' => 'required|max:200|unique:slider_images,title,' . $this->id,
            'description' => '',
            'image_url' => 'required|mimes:jpeg,jpg,png|dimensions:ratio=16/9',
            'alt_text' => 'max:200|unique:slider_images,alt_text,' . $this->id,
            'url_btn_label' => 'max:200|url',
            'url' => 'max:200|url',
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
            'image_url.dimensions' => 'Slider Image is Mast be in 16:9 dimension',
            'image_url.required' => 'Slider Image is required',
            'title.required' => 'title is required',
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
