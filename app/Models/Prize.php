<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $fillable = ['campaign_id', 'product_id', 'title', 'position', 'reword', 'validity'];

    public function campaign(){
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
}
