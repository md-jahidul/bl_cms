<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class CorpResContactUsInfo extends Model
{
    use LogModelAction;
    
    protected $casts = [
        'contact_field' => 'array'
    ];
}
