<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HibernateCustomerMsisdns extends Model
{
    protected $fillable = ['msisdn', 'is_eligible', 'updated_at'];
}
