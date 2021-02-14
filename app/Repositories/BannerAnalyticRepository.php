<?php


namespace App\Repositories;

use App\Models\BannerAnalytic;
use Carbon\Carbon;

class BannerAnalyticRepository extends BaseRepository
{
    public $modelName = BannerAnalytic::class;

    public function getBannerAnalytic($from, $to)
    {
        return $this->model->whereBetween('created_at', [$from, $to])->get();
    }
}
