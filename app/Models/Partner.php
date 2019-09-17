<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'company_name',
        'ceo_name',
        'email',
        'mobile',
        'company_logo',
        'address',
        'website',
        'is_active',
        'services',
    ];
}
