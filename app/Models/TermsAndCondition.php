<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class TermsAndCondition extends Model
{
    protected $fillable = [
        'keyword',
        'body',
        'body_bn',
    ];

}
