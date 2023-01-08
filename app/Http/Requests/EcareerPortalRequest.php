<?php

namespace App\Http\Requests;

use App\Http\Controllers\AssetLite\ConfigController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EcareerPortalRequest extends FormRequest
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
        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        return [
            'banner_name' => 'nullable|regex:/^\S*$/u|unique:ecareer_portals,banner_name,' . $request->id,
            'banner_name_bn' => 'nullable|regex:/^\S*$/u|unique:ecareer_portals,banner_name_bn,' . $request->id,
            'route_slug' => 'nullable|regex:/^\S*$/u|unique:ecareer_portals,route_slug,' . $request->id,
            'route_slug_bn' => 'nullable|regex:/^\S*$/u|unique:ecareer_portals,route_slug_bn,' . $request->id,
            'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ];
    }
}
