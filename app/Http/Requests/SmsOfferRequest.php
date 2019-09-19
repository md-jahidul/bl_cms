<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsOfferRequest extends FormRequest
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
            'title'=>'required|max:200|unique:sms_offers,title,'.$this->id,
            'volume'=>'required|numeric|min:1|max:999999999999999999',
            'validity'=>'required|numeric|min:1|max:999999999999999999',
            'price'=>'required|numeric|min:1|max:999999999999999999',
            'offer_code'=>'required',
            'points'=>'required|numeric|min:1|max:999999999999999999'
        ];
    }
}
