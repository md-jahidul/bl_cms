<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    public function campaign(){
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
}
