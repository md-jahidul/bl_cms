<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerImageRequest extends FormRequest
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
            'partner_category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|integer',
            'platform' => 'required|string|max:255'
        ];
    }
}
