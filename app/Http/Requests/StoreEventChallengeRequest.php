<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventChallengeRequest extends FormRequest
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
            'title'                        => 'required|max:255',
            'title_bn'                     => 'required|max:255',
            'description'                  => 'required|max:255',
            'description_bn'               => 'required|max:255',
            'btn_text'                     => 'required|max:255',
            'btn_text_bn'                  => 'required|max:255',
            'start_date'                   => 'required|max:50',
            'end_date'                     => 'required|max:50',
            'reward_product_code_prepaid'  => 'required|max:50',
            'reward_product_code_postpaid' => 'required|max:50',
            'reward_text'                  => 'required|max:50',
            'status'                       => 'required|boolean',
            'day'                          => 'required|integer',
            'task_pick_type'               => 'required|boolean'
        ];
    }
}
