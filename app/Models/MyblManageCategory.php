<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MyblManageCategory extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];

    public function manageItems()
    {
        return $this->hasMany(MyblManageItem::class, 'manage_categories_id', 'id');
    }
}
