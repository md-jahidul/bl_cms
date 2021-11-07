<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BusinessNewsRequest extends FormRequest
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
            'title' => 'required',
            'title_bn' => 'required',
            'body' => 'required',
            'body_bn' => 'required',
            'image_name_en' => 'required|unique:business_news,image_name_en,' . $request->news_id,
            'image_name_bn' => 'required|unique:business_news,image_name_bn,' . $request->news_id,
        ];
    }
}
