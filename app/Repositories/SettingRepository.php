<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;


use App\Models\Setting;

class SettingRepository extends BaseRepository
{
    public $modelName = Setting::class;
}
