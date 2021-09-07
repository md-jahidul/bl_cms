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
            'icon_image'                   => 'required|file|mimetypes:jpeg,jpg,png,application/json,text/plain',
            'title'                        => 'required|max:150',
            'title_bn'                     => 'required|max:150',
            'description'                  => 'required|max:250',
            'description_bn'               => 'required|max:250',
            'btn_text'                     => 'required|max:20',
            'btn_text_bn'                  => 'required|max:20',
            'recurrence_number'            => 'required|integer',
            'reward_text'                  => 'required|max:30',
            'reward_product_code_prepaid'  => 'required|max:50',
            'reward_product_code_postpaid' => 'required|max:50',
            'event'                        => 'required|max:100',
            'tracking_type'                => 'required|boolean',
            'status'                       => 'required|boolean',
        ];
    }
}
