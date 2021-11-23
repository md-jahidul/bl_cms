<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseMsisdnFile extends Model
{
    protected $fillable = ['base_msisdn_group_id', 'title', 'file_name', 'status'];
}
