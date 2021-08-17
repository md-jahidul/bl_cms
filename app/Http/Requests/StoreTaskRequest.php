<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'icon'             => 'image|mimes:jpeg,jpg,png',
            'title_en'          => 'required|max:150',
            'title_bn'          => 'required|max:150',
            'description_en'    => 'required|max:150',
            'description_bn'    => 'required|max:150',
            'btn_text_en'       => 'required|max:150',
            'btn_text_bn'       => 'required|max:150',
            'recurrence_number' => 'required|numeric',
            'reward_text'       => 'required|max:130',
            'reward_prepaid'    => 'required|max:130',
            'reward_postpaid'   => 'required|max:130',
            'event'             => 'required|max:130',
            'tracking_type'     => 'required|boolean',
            'status'            => 'required|boolean',
        ];
    }
}
