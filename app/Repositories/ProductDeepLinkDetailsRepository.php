<?php


namespace App\Repositories;

use App\Models\ProductDeepLinkDetails;
use Carbon\Carbon;
use \App\Traits\CrudTrait;

class ProductDeepLinkDetailsRepository extends BaseRepository
{
    public $modelName = ProductDeepLinkDetails::class;

    /**
     * @param null $from
     * @param null $to
     * @return mixed
     */
    public function getCountsByActionType($from = null, $to = null)
    {
        $from = is_null($from) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $from . ' 00:00:00')->toDateTimeString();
        $to = is_null($to) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $to . '23:59:59')->toDateTimeString();
        return $this->model->selectRaw('action_type, count(distinct id) total_count, product_code_id')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('action_type', 'product_code_id')
            ->orderBy('product_code_id', 'ASC')
            ->get();
    }
}
