<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CommerceBillUtility extends Model
{
    protected $fillable = ['commerce_bill_category_id', 'name_en', 'name_bn', 'logo','slug','display_order', 'utility_code', 'status'];

    public function dynamicLinks(): MorphOne
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }
}
