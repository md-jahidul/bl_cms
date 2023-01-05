<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LmsOfferCategoryRequest extends FormRequest
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
    {   dd($this->id);
        return [
            'url_slug_en' => 'required|unique:partner_categories,url_slug_en,' . $this->id,
            'url_slug_bn' => 'required|unique:partner_categories,url_slug_bn,' . $this->id,
        ];
    }
}
