<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media'; // Specify the table name if it's different from the model name.

    protected $fillable = [
        'key_name',
        'image_location',
        'settings_key'
    ];
}
