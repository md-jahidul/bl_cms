<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class NotificationCategory extends Model
{
    protected $table = 'notifications_category';
    protected $fillable = [
        'name',
        'slug'
    ];

    public function Notification(){
        return $this->hasMany(Notification::class,'id','category_id');
    }
}
