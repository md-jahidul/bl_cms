<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternetOfferRequest extends FormRequest
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
            'title'=>'required|max:200|unique:internet_offers,title,'.$this->id,
            'volume'=>'required|numeric|min:0|max:999999999999999999',
            'validity'=>'required|numeric|min:1|max:999999999999999999',
            'price'=>'required|numeric|min:1|max:999999999999999999',
            'offer_code'=>'required|unique:internet_offers,offer_code,'.$this->id,
            'points'=>'required|numeric|min:1|max:999999999999999999'
        ];
    }
}
