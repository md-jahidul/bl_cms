<?php

/**
 * Created by PhpStorm.
 * User: shohag
 * Date: 03/01/21
 * Time: 22:07
 */

namespace App\Repositories;

use App\Models\PopupProductPurchaseDetail;
use Carbon\Carbon;

class PopupProductPurchaseDetailRepository extends BaseRepository
{
    public $modelName = PopupProductPurchaseDetail::class;

    public function getCountsByActionType($from = null, $to = null)
    {
        $from = is_null($from) ? Carbon::now()->toDateString() : Carbon::parse($from)->toDateString();
        $to = is_null($to) ? Carbon::now()->toDateString() : Carbon::parse($to)->toDateString();

        return $this->model->selectRaw('action_type, count(distinct id) cnt, popup_product_purchase_id')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('action_type', 'popup_product_purchase_id')
            ->get();
    }
}
