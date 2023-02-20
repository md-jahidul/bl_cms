<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AboutUsBanglalinkRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'content_img_name' => 'unique:about_us_banglalink,content_img_name,' . $request->id,
            'content_img_name_bn' => 'unique:about_us_banglalink,content_img_name_bn,'. $request->id,
            'banner_name' => 'unique:about_us_banglalink,banner_name,' . $request->id,
            'banner_name_bn' => 'unique:about_us_banglalink,banner_name_bn,'. $request->id,
        ];
    }
}
