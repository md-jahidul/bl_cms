<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class WelcomeInfo extends Model
{
    use LogModelAction;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'welcome_info';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_en',
        'message_bn',
        'image',
        'login_button_title',
        'login_button_title_bn',
    ];
}
