<?php

namespace App\Repositories;


use App\Models\SmsLanguage;

class SmsLanguageRepository extends BaseRepository
{

    public $modelName = SmsLanguage::class;

    public function turnStatusToDraft($feature = null)
    {
        return $this->model->where('feature', $feature)->where('status', 1)->update(['status' => 0]);
    }
}
