<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'user_type', 'feature_type',
    ];


    /**
     * Get the users for the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
        // return $this->hasMany(Config("authorization.user-model"));
    }

    /**
     * Get the users for the role.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::Class);

        // return $this->hasMany('Pondit\Authorize\Models\Permission');
    }
}
