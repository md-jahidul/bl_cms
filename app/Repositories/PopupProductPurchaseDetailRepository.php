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

    /**
     * @param null $from
     * @param null $to
     * @param null $purchaseId
     * @return mixed
     */
    public function getCountsByActionType($from = null, $to = null, $purchaseId = null)
    {
        $from = is_null($from) ? Carbon::now()->addYears(-1)->toDateTimeString() : Carbon::createFromFormat('d/m/Y H:i:s',
            $from . ' 00:00:00')->toDateTimeString();
        $to = is_null($to) ? Carbon::now()->toDateTimeString() : Carbon::createFromFormat('d/m/Y H:i:s',
            $to . '23:59:59')->toDateTimeString();

        return is_null($purchaseId) ? $this->model->selectRaw('action_type, count(distinct id) total_count, popup_product_purchase_id')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('action_type', 'popup_product_purchase_id')
            ->get() :
            $this->model->selectRaw('action_type, count(distinct id) total_count, popup_product_purchase_id')
                ->where('popup_product_purchase_id', $purchaseId)
                ->whereBetween('created_at', [$from, $to])
                ->groupBy('action_type')
                ->get();
    }

    /**
     * @param $purchaseId
     * @param $msisdn
     * @param null $from
     * @param null $to
     * @return mixed
     */
    public function getDataByPurchaseId($purchaseLogId, $msisdn = null, $from = null, $to = null)
    {
        $from = is_null($from) ? Carbon::now()->addYears(-1)->toDateTimeString() :
            Carbon::createFromFormat('d/m/Y H:i:s', $from . ' 00:00:00')->toDateTimeString();
        $to = is_null($to) ? Carbon::now()->toDateTimeString() : Carbon::createFromFormat('d/m/Y H:i:s',
            $to . '23:59:59')->toDateTimeString();

        return is_null($msisdn) ? $this->model->where('popup_product_purchase_id', $purchaseLogId)
            ->whereBetween('created_at', [$from, $to])
            ->get() :
            $this->model->where('popup_product_purchase_id', $purchaseLogId)
                ->where('msisdn', $msisdn)
                ->whereBetween('created_at', [$from, $to])
                ->get();
    }
}
