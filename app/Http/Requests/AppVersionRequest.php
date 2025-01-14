<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppVersionRequest extends FormRequest
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
            'platform'        => 'required',
            'current_version' => 'required|max:50',
            'message'         => 'required|max:250',
            'force_update'    => 'required'
        ];
    }
}
