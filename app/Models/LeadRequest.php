<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadRequest extends Model
{
    protected $fillable = ['status'];

    public function leadCategory()
    {
        return $this->belongsTo(LeadCategory::class, 'lead_category_id', 'id');
    }

    public function leadProduct()
    {
        return $this->belongsTo(Product::class, 'lead_product_id', 'id');
    }
}
