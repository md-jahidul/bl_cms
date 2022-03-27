<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AnswerOption extends Model
{
    use LogModelAction;
    protected $fillable = ['question_id', 'option_text', 'is_correct'];
}
