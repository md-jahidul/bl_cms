<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerCategory extends Model
{
    protected $fillable = ['name_en', 'name_bn'];

    public function partner()
    {
       return $this->hasOne(Partner::class);
    }
}
