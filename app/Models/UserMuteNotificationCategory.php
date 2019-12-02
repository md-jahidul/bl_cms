<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMuteNotificationCategory extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_mute_notification_category';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
    ];
}
