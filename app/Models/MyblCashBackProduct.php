<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MyblCashBackProduct extends Model
{
    use LogModelAction;

    protected $fillable = ['mybl_cash_back_id', 'product_code', 'recharge_amount', 'cash_back_amount', 'status', 'start_date', 'end_date', 'override_other_campaign'];
}
