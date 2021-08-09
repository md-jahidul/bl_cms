<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblManageCategory extends Model
{
    protected $guarded = ['id'];

    public function manageItems()
    {
        return $this->hasMany(MyblManageItem::class, 'manage_categories_id', 'id');
    }
}
