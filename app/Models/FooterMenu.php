<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterMenu extends Model
{
    protected $fillable = ['name', 'parent_id', 'en_label_text', 'bn_label_text', 'code', 'url', 'status', 'external_site', 'display_order'];


    public function parent(){
        return $this->hasOne( FooterMenu::class, 'id', 'parent_id' );
    }

    public function children(){
        return $this->hasMany( FooterMenu::class, 'parent_id', 'id' );
    }

}
