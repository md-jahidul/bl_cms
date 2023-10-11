<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\GlobalSetting;

use App\Models\Media;
use DB;

class GlobalMediaSettingRepository extends BaseRepository
{
    public $modelName = Media::class;

    public function is_exist($key)
    {
        return Media::where('key_name', $key)->first();
    }

    public function getFilteredData($filterKey)
    {
        return Media::when($filterKey, function ($query) use ($filterKey) {
            return $query->where('key_name', 'like', '%' . $filterKey . '%');
        })->latest('created_at')->paginate(10); // You can adjust the number of items per page (e.g., 10 per page)
    }

}
