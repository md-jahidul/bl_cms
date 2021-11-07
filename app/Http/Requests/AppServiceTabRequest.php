<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppServiceTabRequest extends FormRequest
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
        $id = $this->route()->parameters()['tab'];
        return [
            'url_slug' => 'required|regex:/^\S*$/u|unique:app_service_tabs,url_slug,' . $id,
            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:app_service_tabs,url_slug_bn,' . $id,
            'banner_name' => 'required|regex:/^\S*$/u|unique:app_service_tabs,banner_name,' . $id,
            'banner_name_bn' => 'required|regex:/^\S*$/u|unique:app_service_tabs,banner_name_bn,' . $id,
        ];
    }
}
