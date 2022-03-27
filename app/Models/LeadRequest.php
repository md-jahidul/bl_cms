<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class LeadRequest extends Model
{
    use LogModelAction;
    
    protected $fillable = ['status'];

    protected $casts = [
        'form_data' => 'array'
    ];

    protected $hidden = ['updated_at'];

    public function leadCategory()
    {
        return $this->belongsTo(LeadCategory::class, 'lead_category_id', 'id');
    }

    public function leadProduct()
    {
        return $this->belongsTo(Product::class, 'lead_product_id', 'id');
    }
}
