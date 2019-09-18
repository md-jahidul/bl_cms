<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NearbyOfferRequest extends FormRequest
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
            'value_exist'=>'required|unique:nearby_offers,title,'.$this->id,
            'title'=>'required',
            'vendor'=>'required',
            'location'=>'required',
            'type'=>'required',
            'offer'=>'required',
            'image'=>'required_if:value_exist,no|image|mimes:jpeg,jpg,png',
            'offer_code'=>'required',
        ];
    }
}
