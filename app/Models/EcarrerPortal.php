<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcarrerPortal extends Model
{
   protected $fillable = ['title', 'slug', 'description', 'image', 'category', 'additional_info', 'is_active', 'has_items', 'deleted_at'];


   public function portalItems(){

   	return $this->hasMany(EcarrerPortalItem::class, 'ecarrer_portals_id');

   }
}
