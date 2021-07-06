<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyblAppMenu extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'other_info' => 'array'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(MyblAppMenu::class, 'parent_id', 'id');
    }

//    public function parent()
//    {
//        return $this->hasOne(MyblAppMenu::class, 'id', 'parent_id');
//    }
}
