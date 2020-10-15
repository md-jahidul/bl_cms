<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorpResContactUsInfo extends Model
{
    protected $casts = [
        'contact_field' => 'array'
    ];
}
