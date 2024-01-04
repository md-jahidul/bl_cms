<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title_en',
        'title_bn',
        'icon',
        'is_title_show',
        'sequence',
        'status',
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
    ];

    /**
     * Get the items for the service.
     */
    public function items()
    {
        return $this->hasMany(MyBlServiceItem::class, 'my_bl_service_id');
    }
}
