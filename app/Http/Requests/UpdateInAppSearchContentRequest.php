<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreInAppSearchContent
 * @package App\Http\Requests
 */
class UpdateInAppSearchContentRequest extends FormRequest
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
        $rules = [
            'display_title' => 'required|max:60|unique:my_bl_search_contents,display_title,' . $this->id,
            'description' => 'max:100',
            'deeplink' => 'max:255',
            'tag' => 'required|array',
        ];

        if ($this->navigation_action == "URL") {
            $rules ['other_attributes'] = 'required|url';
        }

        if ($this->navigation_action == "DIAL") {
            $rules ['other_attributes'] = 'required';
        }
        if ($this->navigation_action == "PURCHASE") {
            $rules ['other_attributes'] = 'required';
        }

        return $rules;
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'other_attributes' => 'Number/ URL/Product Code',
        ];
    }
}
