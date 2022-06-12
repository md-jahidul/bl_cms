<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Authorizable;
use App\Traits\LogModelAction;

class User extends Authenticatable
{
    use Notifiable; //LogModelAction;
    use Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'type', 'uid', 'password_changed_at', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shortcuts()
    {
        return $this->belongsToMany(
            Shortcut::class,
            'shortcut_user',
            'user_id',
            'shortcut_id'
        );
    }

    public function passwordHistories()
    {
        return $this->hasMany('App\Models\PasswordHistory');
    }
}
