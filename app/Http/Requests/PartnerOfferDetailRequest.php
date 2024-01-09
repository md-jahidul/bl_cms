<?php

namespace App\Http\Requests;

use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PartnerOfferDetailRequest extends FormRequest
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
            'banner_image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size, // 2M
//            'banner_name' => 'regex:/^\S*$/u|unique:partner_offer_details,banner_name,' . $request->offer_details_id,
//            'banner_name_bn' => 'regex:/^\S*$/u|unique:partner_offer_details,banner_name_bn,' . $request->offer_details_id,
//            'url_slug' => 'required|regex:/^\S*$/u|unique:partner_offer_details,url_slug,' . $request->offer_details_id,
//            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:partner_offer_details,url_slug_bn,' . $request->offer_details_id,
        ];
    }
}
