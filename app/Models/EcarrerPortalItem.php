<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcarrerPortalItem extends Model
{
  	protected $fillable = ['ecarrer_portals_id', 'title', 'description', 'image', 'video', 'call_to_action', 'additional_info', 'is_active', 'deleted_at'];
}
