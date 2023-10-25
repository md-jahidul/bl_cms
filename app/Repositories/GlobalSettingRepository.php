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
        return $this->modelName::where('settings_key', $key)->first();
    }

    public function delEntryBySettingsKey($keyname)
    {
        return $this->modelName::where('settings_key', $keyname)->delete();
    }
//->where('status', 1)
    public function getFilteredData($filterKey)
    {
        return GlobalSetting::when($filterKey, function ($query) use ($filterKey) {
            return $query
                ->where(function ($q) use ($filterKey) {
                    $q
                        ->where('settings_key', 'like', '%' . $filterKey . '%');
                });

        })->latest('created_at')->paginate(10); // You can adjust the number of items per page (e.g., 10 per page)
    }
}
