<?php


namespace App\Models;

use App\Models\AgentList;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AgentDeeplink
 * @package App\Models
 */

class AgentDeeplink extends Model
{
    protected $fillable = [
        'agent_id',
        'deeplink_type',
        'product_code',
        'deep_link',
        'full_link',
        'total_view',
        'total_buy',
        'total_cancel',
        'buy_attempt'
    ];


    /**
     * Get Product Info
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agentInfo()
    {
        return $this->belongsTo(AgentList::class, 'agent_id', 'id');
    }

}
