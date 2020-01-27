<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateMyblProductRequest
 * @package App\Http\Requests
 */
class UpdateMyblProductRequest extends FormRequest
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
            'offer_section_slug'    => 'string|exists:my_bl_internet_offers_categories,slug',
            'tag'                   => 'max:10',
            'show_in_app'           => 'boolean',
            'is_rate_cutter_offer'  => 'boolean',
            'media'                 => 'mimes:jpeg,jpg,png|dimensions:ratio=16/9|max:3000'
        ];
    }

    public function messages()
    {
        return [
            'media.dimensions' => 'Image ratio must be in 16:9',
            'media.mimes'      => 'Image must be in jpeg or jpg or png format',
        ];
    }
}
