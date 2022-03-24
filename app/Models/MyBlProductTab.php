<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MyBlProductTab extends Model
{
    use LogModelAction;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_code', 'my_bl_internet_offers_category_id'];
}
