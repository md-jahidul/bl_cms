<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class NewPageComponent extends Model
{
    protected $guarded = ['id'];

    public function componentData()
    {
        return $this->hasMany(NewPageComponentData::class,  'component_id', 'id');
    }
}
