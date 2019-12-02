<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmarOfferRequest extends FormRequest
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
            'title' => 'required|max:200|unique:amar_offers,title,' . $this->id,
            'internet' => 'required|numeric|min:0|max:500000',
            'minutes' => 'required|numeric|min:0|max:500000',
            'sms' => 'required|numeric|min:0|max:500000',
            'validity' => 'required|numeric|min:0|max:500000',
            'price' => 'required|numeric|min:0|max:500000',
            'offer_code' => 'required|max:200|unique:amar_offers,offer_code,' . $this->id,
            'tag' => 'max:200',
            'points' => 'required|numeric|min:0|max:500000'
        ];
    }
}
