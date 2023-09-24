<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyPlanProductRequest extends FormRequest
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
            'sim_type' => 'required',
            'product_code' => 'required:unique:my_plan_products,product_code,' . $this->id,
            'market_price' => 'required',
            'discount_price' => 'required',
            "savings_amount" => 'required',
            'discount_percentage' => 'required',
            'validity' => 'required',
            'validity_unit' => 'required',
            'display_sd_vat_tax_en' => 'required',
            'display_sd_vat_tax_bn' => 'required',
            'is_active' => 'required',
        ];
    }
}
