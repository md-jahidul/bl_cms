<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MyblDynamicDeeplink;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Relations\MorphOne;


class CommerceBillCategory extends Model
{
    protected $fillable = ['title_en', 'title_bn', 'logo', 'slug', 'display_order', 'status'];

    public function dynamicLinks(): MorphOne
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }

}
