<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\GlobalSetting;

use DB;

class GlobalSettingRepository extends BaseRepository
{
    public $modelName = GlobalSetting::class;

    public function is_exist($key)
    {
        return GlobalSetting::where('settings_key', $key)->first();
    }
}
