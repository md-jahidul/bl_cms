<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreInAppSearchContent
 * @package App\Http\Requests
 */
class StoreInAppSearchContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|max:60|unique:my_bl_search_contents,display_title,' . $this->id,
            'description' => 'max:100',
            'tags' => 'required|array',
        ];

        if ($this->navigation_action == "URL") {
            $rules ['other_info'] = 'required|url';
        }

        if ($this->navigation_action == "DIAL") {
            $rules ['other_info'] = 'required';
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
            'other_info' => 'Number/ URL',
        ];
    }
}
