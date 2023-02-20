<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContextualCardIcon;

class ContextualCards extends Model
{
    use LogModelAction;
    
    protected $table = 'contextual_cards';
    protected $fillable = [
        'title',
        'description',
        'campaign_id',
        'url',
        'component',
        'navigation',
        'image_url',
        'icon_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getIcon()
    {
        return $this->belongsTo(ContextualCardIcon::class, 'icon_id','card_number');
    }
}
