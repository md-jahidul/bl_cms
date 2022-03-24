<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class OtherRelatedProduct extends Model
{
    use LogModelAction;
    
    protected $fillable = ['product_id', 'other_offer_id', 'related_product_id'];
}
