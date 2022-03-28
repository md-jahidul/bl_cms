<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class FooterMenu extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'parent_id',
        'en_label_text',
        'bn_label_text',
        'code', 'url',
        'url_bn',
        'status',
        'external_site',
        'display_order',
        'is_dynamic_page',
        'dynamic_page_slug'
    ];

    public function parent()
    {
        return $this->hasOne(FooterMenu::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(FooterMenu::class, 'parent_id', 'id');
    }
}
