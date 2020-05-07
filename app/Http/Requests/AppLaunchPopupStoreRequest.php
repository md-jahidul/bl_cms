<?php

namespace App\Http\Requests;

use App\Rules\ValidDateRange;
use Illuminate\Foundation\Http\FormRequest;

class AppLaunchPopupStoreRequest extends FormRequest
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
            'title'          => 'required|max:20|unique:my_bl_app_launch_popups,title',
            'type'           => 'required|in:image,html',
            'display_period' => new ValidDateRange(),
            'content_data'        => 'required'
        ];
    }
}
