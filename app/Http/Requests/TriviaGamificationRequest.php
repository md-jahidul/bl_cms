<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TriviaGamificationRequest extends FormRequest
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
            'banner' => 'required_without:id',
            'pending_bottom_label_en' => 'required|max:200',
            'pending_bottom_label_bn' => 'required|max:200',
            'completed_bottom_label_en' => 'required|max:200',
            'completed_bottom_label_bn' => 'required|max:200',
            'success_left_btn_en' => 'required|max:200',
            'success_left_btn_bn' => 'required|max:200',
            'success_left_btn_deeplink' => 'required|max:200',
            'success_right_btn_en' => 'required|max:200',
            'success_right_btn_bn' => 'required|max:200',
            'success_right_btn_deeplink' => 'required|max:200',
            'failed_left_btn_en' => 'required|max:200',
            'failed_left_btn_bn' => 'required|max:200',
            'failed_left_btn_deeplink' => 'required|max:200',
            'failed_right_btn_en' => 'required|max:200',
            'failed_right_btn_bn' => 'required|max:200',
            'failed_right_btn_deeplink' => 'required|max:200',
            'success_message_en' => 'required|max:200',
            'success_message_bn' => 'required|max:200',
            'failed_message_en' => 'required|max:200',
            'failed_message_bn' => 'required|max:200',
            'show_answer_btn_en' => 'required|max:200',
            'show_answer_btn_bn' => 'required|max:200',
            'type' => 'required'
        ];
    }
}
