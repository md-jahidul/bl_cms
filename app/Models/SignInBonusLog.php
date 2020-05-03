<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SignInBonusLog
 * @package App\Models
 */
class SignInBonusLog extends Model
{
    protected $fillable = [
        'msisdn',
        'date',
        'status'
    ];
}
