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
            // TODO: Product Code Unique check on Edit
//            'product_code' => 'required|unique:partner_offers,product_code,' . $this->user,
            'validity_en' => 'required',
            'validity_bn' => 'required',
//            'offer_scale' => 'required',
//            'offer_value' => 'required',
//            'offer_unit' => 'required',
            'get_offer_msg_en' => 'required',
            'get_offer_msg_bn' => 'required',
            'btn_text_en' => 'required',
            'btn_text_bn' => 'required',
            'is_active' => 'required',
//            'url_slug' => 'required|regex:/^\S*$/u|unique:partner_offers,url_slug,' . $this->id,
//            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:partner_offers,url_slug_bn,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'validity_en.required' => "Enter offer validity english.",
            'validity_bn.required' => "Enter offer validity in Bangla.",
            'get_offer_msg_en.required' => "Enter get send SMS text english.",
            'get_offer_msg_bn.required' => "Enter get send SMS text in Bangla.",
            'btn_text_en.required' => "Enter button label english.",
            'btn_text_bn.required' => "Enter button label in Bangla",
        ];
    }
}
