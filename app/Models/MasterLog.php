<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterLog extends Model
{
    protected $fillable = ['msisdn','date', 'data', 'response', 'message' ,'status', 'log_type', 'device_id','others','ip_address','browse_url'];
}
