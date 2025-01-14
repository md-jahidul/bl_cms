<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
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
            'name' => 'required|max:200|unique:banners,name,' . $this->id,
            'code' => 'required',
            'redirect_url' => 'required',
            'image_name' => 'required',
            'image_path' => 'image|mimes:jpeg,jpg,png|dimensions:ratio=16/9'
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image_path.dimensions' => 'Image dimension must be in 16:9',
        ];
    }
}
