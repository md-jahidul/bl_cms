<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoamingOfferRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name_en' => 'required',
            'name_bn' => 'required',
            'card_text_en' => 'required',
            'card_text_bn' => 'required',
            'banner_name' => 'required|regex:/^\S*$/u|unique:roaming_other_offer,banner_name,' . $request->offer_id,
            'banner_name_bn' => 'required|regex:/^\S*$/u|unique:roaming_other_offer,banner_name_bn,' . $request->offer_id,
            'url_slug' => 'required|regex:/^\S*$/u|unique:roaming_other_offer,url_slug,' . $request->offer_id,
            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:roaming_other_offer,url_slug_bn,' . $request->offer_id,
        ];
    }
}
