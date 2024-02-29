<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GamificationTypeRequest extends FormRequest
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
        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();

            return [
                'trivia_gamification_ids' => 'required',
            ];

        }else {
            return [
                'trivia_gamification_ids' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [];
    }
}
