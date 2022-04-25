<?php


namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AgentDeeplinkDetail  extends Model
{
    use LogModelAction;
    protected $fillable = [
        'agent_deeplink_id',
        'msisdn',
        'action_type',
        'action_status'
    ];
}
