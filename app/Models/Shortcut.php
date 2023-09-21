<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortcut extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'title_bn','icon','component_identifier','is_default','dial_number','other_info', 'customer_type',
        'android_version_code_min', 'android_version_code_max', 'ios_version_code_min', 'ios_version_code_max'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'shortcut_user',
            'shortcut_id',
            'user_id'
        );
    }
}
