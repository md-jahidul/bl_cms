<?php

namespace App\Http\Requests\Feed;

use Illuminate\Foundation\Http\FormRequest;

class StoreYoutubeFeedRequest extends FormRequest
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
            'category_id'   => 'required|exists:feed_categories,id',
            'titles'         => 'required',
            'description'   => 'required',
            'video_url'     => 'required',
            'preview_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
