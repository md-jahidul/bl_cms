<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuickNotificationRequest extends FormRequest
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
            // 'title'=>'required|max:200|unique:notifications,title,'.$this->id,
            'title' => 'required|max:200',
            'category_id' => 'required|min:1',
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.min' => 'category is requred'
        ];
    }
}
