<?php


namespace App\Repositories;

use App\Models\BannerAnalyticDetails;
use App\Models\BannerProductPurchaseDetail;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BannerAnalyticDetailsRepository extends BaseRepository
{
    public $modelName = BannerAnalyticDetails::class;

    /**
     * @param $id
     * @param null $from
     * @param null $to
     * @return mixed
     */
    public function getDetailsByIdDateTodate($id, $from = null, $to = null)
    {
        return $this->model->where('banner_analytic_id', $id)->whereBetween('created_at', [$from, $to])->get();
    }

    /**
     * @param null $from
     * @param null $to
     * @return mixed
     */
    public function getCountsByActionType($from = null, $to = null)
    {
        $from = is_null($from) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $from . ' 00:00:00')->toDateTimeString();
        $to = is_null($to) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $to . '23:59:59')->toDateTimeString();
        return DB::table('banner_analytic_details as bad')
        ->rightJoin('banner_analytics','bad.banner_analytic_id','=','banner_analytics.id')
        ->selectRaw('bad.action_type, count(distinct bad.id) total_count,bad.banner_analytic_id,slider_id')
            ->whereBetween('bad.created_at', [$from, $to])
            ->groupBy('bad.action_type', 'bad.banner_analytic_id')
            // ->orderBy('banner_analytic_id', 'ASC')
            ->get();

    }


    /**
     * @param null $from
     * @param null $to
     * @return mixed
     */
    public function getPurchaseCountsByActionType($from = null, $to = null)
    {
        $from = is_null($from) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $from . ' 00:00:00')->toDateTimeString();
        $to = is_null($to) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $to . '23:59:59')->toDateTimeString();
        // return BannerProductPurchaseDetail::selectRaw('error_desc as error_title, count(distinct id) total_count, banner_product_purchase_id')
        //     // ->with('getProductPurchaseBannerInfo')
        //     ->join('banner_product_purchases.')
        //     ->whereBetween('created_at', [$from, $to])
        //     ->groupBy('error_desc', 'banner_product_purchase_id')
        //     ->orderBy('banner_product_purchase_id', 'ASC')
        //     ->get();

        return DB::table('banner_product_purchase_details as bppd')
        ->rightJoin('banner_product_purchases','bppd.banner_product_purchase_id','=','banner_product_purchases.id')
        ->selectRaw('bppd.action_type, count(distinct bppd.id) total_count, bppd.banner_product_purchase_id,banner_product_purchases.slider_id,banner_product_purchases.slider_image_id')
        ->whereBetween('bppd.created_at', [$from, $to])
        ->groupBy('bppd.action_type', 'banner_product_purchase_id')
        ->orderBy('bppd.banner_product_purchase_id', 'ASC')
        ->get();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getDetailsById($id)
    {
        return $this->model->where('banner_analytic_id', $id)->get();
    }


    /**
     * @param $id
     * @param null $from
     * @param null $to
     * @return mixed
     */
    public function getPurchaseDetailsByIdDateTodate($id, $from = null, $to = null)
    {
        return BannerProductPurchaseDetail::where('banner_product_purchase_id', $id)->whereBetween('created_at', [$from, $to])->get();
    }
}
