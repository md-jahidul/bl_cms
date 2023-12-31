<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VasProductRequest extends FormRequest
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
                'subscription_offer_id' => 'required|unique:mybl_vas_products,subscription_offer_id,'. $this->subscription_offer_id,
                'partner_id' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'subscription_offer_id.unique' => 'This Subscription Offer ID already exists ',
        ];
    }
}
