<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UssdRequest extends FormRequest
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
        //dd($this->id);
        return [
            'title'=>'required|max:200|unique:ussd_codes,title,'.$this->id,
            'code'=>'required|unique:ussd_codes,code,'.$this->id,
            'purpose'=>'required',
            'provider'=>'required',
        ];
    }
}
