<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContextualCardIconRequest  extends FormRequest
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
            'card_number' => 'required|max:100|unique:contextual_card_icons,card_number,' . $this->id,
//            'remark' => 'required',
            'category' => 'required',
            'icon' => 'required_if:value_exist,no|image|mimes:jpeg,jpg,png|dimensions:ratio=1/1'
        ];
    }

    public function messages()
    {
        return [
            'icon.dimensions' => 'Image dimension must be in 1:1',
        ];
    }
}
