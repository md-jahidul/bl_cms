<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class RoamingBundleOffer extends Model
{
    use LogModelAction;
    
    protected $fillable = ['details_en', 'details_bn'];
}
