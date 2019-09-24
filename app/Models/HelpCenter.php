<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    protected $table = 'help_centers';
    protected $fillable = [
        'title',
        'icon',
        'redirect_link',
        'sequence'
    ];
}
