<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\Setting;
use DB;

class SettingRepository extends BaseRepository
{
    public $modelName = Setting::class;

    public function is_exist($id)
    {
        $data = DB::table('settings')->where('setting_key_id', $id)->first();
        return $data;
    }
}
