<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AboutUsManagementRequest extends FormRequest
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
        $id = $this->route('management') ? $this->route('management')->id : null;
        return [
            'profile_img_name' => 'unique:about_us_manangement,profile_img_name,' . $id,
            'profile_img_name_bn' => 'unique:about_us_manangement,profile_img_name_bn,' . $id,
            'banner_img_name' => 'unique:about_us_manangement,banner_img_name,' . $id,
            'banner_img_name_bn' => 'unique:about_us_manangement,banner_img_name_bn,' . $id,
        ];
    }
}
