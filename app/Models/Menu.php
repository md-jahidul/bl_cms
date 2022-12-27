<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use LogModelAction;

    protected $fillable = [
        'parent_id', 'en_label_text', 'bn_label_text',
        'description_en', 'description_bn', 'icon',
        'external_site', 'code', 'url', 'url_bn',
        'status', 'display_order'
    ];


    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Menu::class, 'id', 'parent_id');
    }
}
