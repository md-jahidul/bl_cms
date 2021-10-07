<?php

namespace App\Helpers;

use App\Models\BaseMsisdn;
use App\Models\BaseMsisdnGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BaseMsisdnHelper
{

    /**
     * Base Msisdn Check
     * @return bool
     */
    public static function baseMsisdnAddInRedis($baseGroupId, $ttl = 300): bool
    {
        $redis_key = "base_msisdn_$baseGroupId";
        if (!Redis::get($redis_key)) {
            $baseGroup = BaseMsisdnGroup::where('id', $baseGroupId)->where('status', 1)->first();
            if ($baseGroup) {
                $msisdnInfo = BaseMsisdn::where('group_id', $baseGroupId)
                    ->select('msisdn')
                    ->pluck('msisdn')
                    ->toArray();
            } else {
                return false;
            }
            Redis::setex($redis_key, $ttl, json_encode($msisdnInfo));
        }
        return true;
    }
}
