<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class NotificationCategory extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications_category';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications(){
        return $this->hasMany(Notification::class,'category_id','id');
    }
}
