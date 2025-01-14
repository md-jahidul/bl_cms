<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
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
            'msisdn' => 'required|max:200|unique:agent_lists,msisdn,'. $this->id,
            'email' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'msisdn.unique' => 'This agent already exists ',
        ];
    }
}
