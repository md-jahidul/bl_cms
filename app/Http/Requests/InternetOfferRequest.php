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
            'title' => 'required|max:40|unique:internet_offers,title,' . $this->id,
            'volume' => 'required|numeric|min:0|max:5120',
            'validity' => 'required|numeric|min:1|max:30',
            'price' => 'required|numeric|min:1|max:2000',
            'offer_code' => 'required|unique:my_bl_internet_offers,offer_code,' . $this->id,
        ];
    }
}
