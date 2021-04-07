<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AgentDeeplinkDetail  extends Model
{
    protected $fillable = [
        'agent_deeplink_id',
        'msisdn',
        'action_type',
        'action_status'
    ];
}
