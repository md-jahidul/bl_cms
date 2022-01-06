<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderEnrichmentLog extends Model
{
    protected $fillable = ['msisdn', 'response_status'];
}
