<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentDeeplinkRequest extends FormRequest
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

        if ($this->attributes->get('deeplink_type') == 'signup') {
            return [
                'deeplink_type' => 'required',
                'agent_id' => 'required'
            ];
        }
        return [
            'product_code' => 'sometimes|required',
            'deeplink_type' => 'required',
            'agent_id' => 'required'
        ];
    }

    public function messages()
    {
        return [  ];
    }
}
