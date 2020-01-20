<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Helper;

class StoreSliderImageRequest extends FormRequest
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
        $image_upload_size = Helper::getImageUploadSize();
        $image_upload_type = Helper::getimageUploadType();

        return [
            'title_bn' => 'required',
//            'description' => 'required',
            'image_url' => 'mimes:'.$image_upload_type.'|max:'.$image_upload_size,
            'alt_text' => 'required',
//            'url_btn_label' => 'required',
//            'redirect_url' => 'required',
            'is_active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Enter english title",
            'description.required' => "Enter description in Bangla",
            'alt_text.required' => "Enter alt ext",
            'url_btn_label.required' => "Enter button url",
            'redirect_url.required' => "Enter redirect url",
            'image_url.mimes' => "Enter jpg, png file type",
            'image_url.max' => "Enter file less than 2M",
        ];
    }
}
