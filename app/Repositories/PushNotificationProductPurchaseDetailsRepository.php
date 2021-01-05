<?php


namespace App\Repositories;

use App\Models\PushNotificationProductPurchaseDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PushNotificationProductPurchaseDetailsRepository extends BaseRepository
{
    public $modelName = PushNotificationProductPurchaseDetails::class;

    /**
     * @param null $from
     * @param null $to
     * @return mixed
     */
    public function getCountsByActionType($from = null, $to = null)
    {
        $from = is_null($from) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $from . ' 00:00:00')->toDateTimeString();
        $to = is_null($to) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $to . '23:59:59')->toDateTimeString();
        return $this->model->selectRaw('action_type, count(distinct id) total_count, push_notification_product_purchase_id')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('action_type', 'push_notification_product_purchase_id')
            ->orderBy('push_notification_product_purchase_id', 'ASC')
            ->get();
    }
}
