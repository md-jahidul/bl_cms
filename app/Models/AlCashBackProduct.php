<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlCashBackProduct extends Model
{
    use LogModelAction;

    protected $fillable = ['al_cash_back_id', 'product_code', 'recharge_amount', 'cash_back_amount', 'status', 'start_date', 'end_date'];
}
