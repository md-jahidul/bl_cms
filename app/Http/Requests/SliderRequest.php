<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'component_id' => 'required',
            'title' => 'required|unique:sliders,title,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Name is required',
            'component_id.required' => 'Slider type is required',
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
