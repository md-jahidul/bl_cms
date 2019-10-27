<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected  $fillable = ['parent_id','en_label_text', 'bn_label_text', 'external_site', 'code' ,'url', 'status', 'display_order'];


    public function children(){
        return $this->hasMany( Menu::class, 'parent_id', 'id' );
    }

    public function parent(){
        return $this->hasOne( Menu::class, 'id', 'parent_id' );
    }
}
