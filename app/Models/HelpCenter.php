<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    use LogModelAction;
    
    protected $table = 'help_centers';
    protected $fillable = [
        'title',
        'icon',
        'redirect_link',
        'sequence'
    ];
}
