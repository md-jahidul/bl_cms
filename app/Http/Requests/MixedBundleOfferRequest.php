<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MixedBundleOfferRequest extends FormRequest
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
            'title'=>'required|max:200|unique:mixed_bundle_offers,title,'.$this->id,
            'internet'=>'required|numeric|min:0|max:999999999999999999',
            'minutes'=>'required|numeric|min:0|max:999999999999999999',
            'sms'=>'required|numeric|min:0|max:999999999999999999',
            'validity'=>'required|numeric|min:1|max:999999999999999999',
            'price'=>'required|numeric|min:1|max:999999999999999999',
            'points'=>'required|numeric|min:0|max:999999999999999999',
            'offer_code'=>'required|',
            'tag'=>'required',
        ];
    }
}
