<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventCampaignRequest extends FormRequest
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
            'title'                        => 'required|max:150',
            'description'                  => 'required|max:250',
            'description_bn'               => 'required|max:250',
            'start_date'                   => 'required|max:50',
            'end_date'                     => 'required|max:50',
            'reward_product_code_prepaid'  => 'required|max:50',
            'reward_product_code_postpaid' => 'required|max:50',
            'task_ids'                     => 'required',
            'status'                       => 'required|boolean',
        ];
    }
}
