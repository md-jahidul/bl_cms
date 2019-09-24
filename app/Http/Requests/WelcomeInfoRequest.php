<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WelcomeInfoRequest extends FormRequest
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
            'guest_salutation'=>'required|max:200',
            'user_salutation'=>'required|max:200',
            'guest_message'=>'required',
            'user_message'=>'required',
            'icon'=>'required_if:update,yes|image|mimes:jpeg,jpg,png'
        ];
    }
}
