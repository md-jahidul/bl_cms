<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlProduct extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * Get Product Info
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function details()
    {
        return $this->belongsTo(ProductCore::class, 'product_code', 'product_code');
    }

}
