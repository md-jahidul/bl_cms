<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternetGiftContentRequest extends FormRequest
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
        $contentId = $this->route()->parameters()['internet_gift_content'] ?? '';
        return [
            // 'slug' => 'required|max:200|unique:internet_gift_contents,slug,' . $contentId,
            'name_en' => 'required',
            'name_bn' => 'required',
        ];
    }
}
