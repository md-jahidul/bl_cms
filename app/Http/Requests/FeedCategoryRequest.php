<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedCategoryRequest extends FormRequest
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
            'title' => 'required|max:200',
            //'ordering' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Enter feed category name",
            //'ordering.required' => 'Enter feed category ordering',
            'status.required' => 'Select status active/inactive',
        ];
    }
}
