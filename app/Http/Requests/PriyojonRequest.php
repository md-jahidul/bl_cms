<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriyojonRequest extends FormRequest
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
            'title_en' => 'required',
            'title_bn' => 'required',
            'url_slug_en' => 'unique:priyojons,url_slug_en,' . $this->id,
            'url_slug_bn' => 'unique:priyojons,url_slug_bn,' . $this->id,
        ];
    }
}
