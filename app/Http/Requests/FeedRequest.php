<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedRequest extends FormRequest
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
            'category_id' => 'required|exists:my_bl_feed_categories,id',
            'title' => 'required|max:200',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => "Select feed category",
            'title.required' => "Enter feed title",
            'status.required' => 'Select status active/inactive',
        ];
    }
}
