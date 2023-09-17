<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TriviaGamification extends Model
{
    protected $fillable = [
        'id',
        "banner",
        "pending_bottom_label_en",
        "pending_bottom_label_bn",
        "completed_bottom_label_en",
        "completed_bottom_label_bn",
        "success_left_btn_en",
        "success_left_btn_bn",
        "success_left_btn_deeplink",
        "success_right_btn_en",
        "success_right_btn_bn",
        "success_right_btn_deeplink",
        "failed_left_btn_en",
        "failed_left_btn_bn",
        "failed_left_btn_deeplink",
        "failed_right_btn_en",
        "failed_right_btn_bn",
        "failed_right_btn_deeplink",
        "success_message_en",
        "success_message_bn",
        "failed_message_en",
        "failed_message_bn",
        "show_answer_btn_en",
        "show_answer_btn_bn",
        "type",
        "rule_name",
        "content_for"
    ];
}
