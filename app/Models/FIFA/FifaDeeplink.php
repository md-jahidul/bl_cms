<?php

namespace App\Models\FIFA;

use App\Models\MyblDynamicDeeplink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class FifaDeeplink extends Model
{
    protected $fillable = ['category_name', 'detail_id', 'slug'];

    public function dynamicLinks(): MorphOne
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }
}
