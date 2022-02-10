<?php

namespace App\Repositories;


use App\Models\SmsLanguage;

class SmsLanguageRepository extends BaseRepository
{

    public $modelName = SmsLanguage::class;

    public function turnStatusToDraft($feature = null, $platform = 'mybl')
    {
        return $this->model->where('feature', $feature)->where('platform', $platform)->where('status', 1)->update(['status' => 0]);
    }
}
