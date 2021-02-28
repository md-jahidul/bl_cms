<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyBlInternetOffersCategoryRequest extends FormRequest
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
            'name' => 'required|max:200|unique:my_bl_internet_offers_categories,name,'. $this->id,
            'slug' => 'required|max:200|unique:my_bl_internet_offers_categories,slug,'. $this->id,
            'sort' => 'required|min:0',
        ];
    }
}
