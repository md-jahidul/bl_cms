<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MyBlInternetOffer extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(MyBlInternetOffersCategory::class, 'category_id');
    }

}
