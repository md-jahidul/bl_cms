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
//        $id = $this->route()->parameters()['offer_category'];
//        $image_upload_size = ConfigController::adminImageUploadSize();
//        $image_upload_type = ConfigController::adminImageUploadType();
        return [
//            'banner_name' => !empty($request->banner_name) ? 'regex:/^\S*$/u' : '',
            'url_slug_en' => 'required|unique:media_press_news_events,url_slug_en,' . $this->id,
            'url_slug_bn' => 'required|unique:media_press_news_events,url_slug_bn,' . $this->id,
//            'banner_name' => 'required|regex:/^\S*$/u|unique:offer_categories,banner_name,' . $id,
//            'banner_name_web_bn' => 'required|unique:offer_categories,banner_name_web_bn,' . $id,
//            'banner_image_url' => 'mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ];
    }
}
