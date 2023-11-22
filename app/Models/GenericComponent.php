<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericComponent extends Model
{
    protected $fillable = ['title_en', 'title_bn', 'status', 'component_key'];


    public function items()
    {
        return $this->hasMany(GenericComponentItem::class, 'generic_component_id', 'id');
    }
}
