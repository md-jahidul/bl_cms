<?php

namespace App\Models\NewCampaignModality;

use App\Models\MyblDynamicDeeplink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MyBlCampaignSection extends Model
{
    protected $fillable = ['id', 'title_en', 'title_bn', 'slug', 'display_order', 'status'];

    public function dynamicLinks(): MorphOne
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }
}
