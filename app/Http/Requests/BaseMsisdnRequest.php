<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseMsisdnRequest extends FormRequest
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
            'title' => 'required|max:200|unique:base_msisdn_groups,title,'. $this->id,
            'status' => 'required',
//            'msisdn_file'=>'sometimes|in:csv,xlsx,xls',
//            'custom_msisdn'=>'sometimes|required'
            ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'This title already exists ',
            'msisdn_file.required' => 'Please select file only xlsx or csv',
        ];
    }
}
