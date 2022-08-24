<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoamingCategoriesRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $id = $request->cat_id;
        return [
            'name_en' => 'required',
            'name_bn' => 'required',
            'page_url' => 'required|regex:/^\S*$/u',
            'page_url_bn' => 'required|regex:/^\S*$/u',
            'banner_name' => 'required|regex:/^\S*$/u|unique:roaming_cagegories,banner_name,' . $id,
            'banner_name_bn' => 'required|regex:/^\S*$/u|unique:roaming_cagegories,banner_name_bn,' . $id,
        ];
    }
}
