<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    protected $table = 'internet_offers';
    protected $fillable = [
        'title',
        'icon',
        'redirect_link',
        'sequence'
    ];
}
