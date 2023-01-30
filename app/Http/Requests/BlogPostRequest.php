<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BlogPostRequest extends FormRequest
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
       

        if ($this->method() == "PUT") {
            // $id = $this->route()->parameters();
            
            return [
                'title_en' => 'required',
                'title_bn' => 'required',
                'url_slug_en' => 'required|unique:media_press_news_events,url_slug_en,' . $this->id,
                'url_slug_bn' => 'required|unique:media_press_news_events,url_slug_bn,' . $this->id,
            ];
        } else {
            return [
                'title_en' => 'required',
                'title_bn' => 'required',
                'url_slug_en' => 'required|unique:media_press_news_events,url_slug_en',
                'url_slug_bn' => 'required|unique:media_press_news_events,url_slug_bn',
            ];
        }
    }

    public function messages()
    {
        return [
            'title_en.required' => "Enter blog's title",
        ];
    }
}
