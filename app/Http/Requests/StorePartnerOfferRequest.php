<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerOfferRequest extends FormRequest
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
            'validity_en' => 'required',
            'validity_bn' => 'required',
            'offer_en' => 'required',
            'offer_bn' => 'required',
            'get_offer_msg_en' => 'required',
            'get_offer_msg_bn' => 'required',
            'btn_text_en' => 'required',
            'btn_text_bn' => 'required',
            'is_active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'validity_en.required' => "Enter offer validity english.",
            'validity_bn.required' => "Enter offer validity bangla.",
            'offer_en.required' => "Enter offer percentage english.",
            'offer_bn.required' => "Enter offer percentage bangla.",
            'get_offer_msg_en.required' => "Enter get send SMS text english.",
            'get_offer_msg_bn.required' => "Enter get send SMS text bangla.",
            'btn_text_en.required' => "Enter button label english.",
            'btn_text_bn.required' => "Enter button label bangla",
        ];
    }
}
