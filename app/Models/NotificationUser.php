<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notification_user';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'notification_id',
    ];
}
