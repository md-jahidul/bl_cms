<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NotificationCategory;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'category_id',
        'title',
        'body'
    ];
    public function NotificationCategory()
    {
        return $this->belongsTo(NotificationCategory::class,'category_id');
        
    }


}
