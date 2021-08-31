<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblCashBackProduct extends Model
{
    protected $fillable = ['mybl_cash_back_id', 'product_code', 'recharge_amount', 'cash_back_amount', 'status'];
}
