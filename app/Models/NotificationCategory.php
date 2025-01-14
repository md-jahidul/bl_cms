<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class NotificationCategory extends Model
{
    use Sluggable;
    use LogModelAction;

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
    public function notifications()
    {
        return $this->hasMany(NotificationDraft::class, 'category_id', 'id');
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
