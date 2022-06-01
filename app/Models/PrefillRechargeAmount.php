<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class PrefillRechargeAmount extends Model
{
    //protected $guarded = ['id'];
    protected $fillable = ['amount', 'sort', 'type'];
}
