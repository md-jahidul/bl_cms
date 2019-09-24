<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeInfo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'welcome_info';


    protected $fillable = [
        'guest_salutation',
        'user_salutation',
        'guest_message',
        'user_message',
        'icon'
    ];
}