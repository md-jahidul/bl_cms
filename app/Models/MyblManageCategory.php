<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblManageCategory extends Model
{
    protected $guarded = ['id'];

    public function manageItems()
    {
        return $this->hasMany(MyblManageCategory::class, 'id', 'manage_category_id');
    }
}
