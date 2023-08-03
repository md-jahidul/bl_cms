<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeProductDisburse extends Model
{
    protected $fillable = ['file_id', 'msisdn', 'product_code', 'is_disburse'];
}
