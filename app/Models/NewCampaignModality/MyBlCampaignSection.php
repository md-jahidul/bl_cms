<?php

namespace App\Models\NewCampaignModality;

use App\Models\MyblDynamicDeeplink;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MyBlCampaignSection extends Model
{
    use LogModelAction;

    protected $table = 'my_bl_campaign_sections';
    protected $fillable = ['id', 'title_en', 'title_bn', 'slug', 'display_order', 'status'];

    public function dynamicLinks(): MorphOne
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }

    public function campaigns()
    {
        return $this->hasMany(MyBlCampaign::class, 'mybl_campaign_section_id', 'id');
    }
}
