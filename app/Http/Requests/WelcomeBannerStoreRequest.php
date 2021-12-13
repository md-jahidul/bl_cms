<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WelcomeBannerStoreRequest extends FormRequest
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
            'title_en' => 'required|max:200',
            'title_bn' => 'required|max:200',
            'description_en' => 'required|max:200',
            'description_bn' => 'required|max:200',
            'banner_img' => 'required|image|mimes:jpeg,jpg,png|dimensions:min_width=360,min_height=460,max_width=360,max_height=460|max:100'
        ];
    }
}
