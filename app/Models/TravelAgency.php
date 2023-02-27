<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TravelAgency extends Model
{
    protected $fillable = ['title_en', 'title_bn', 'icon', 'component_key', 'user_type', 'status', 'display_order', 'deeplink'];

    public function dynamicLinks(): MorphOne
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }
}
