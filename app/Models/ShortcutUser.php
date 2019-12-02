<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortcutUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'shortcut_user';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'shortcut_id',
        'serial'
    ];
}
