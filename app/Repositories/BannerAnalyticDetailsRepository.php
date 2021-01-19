<?php


namespace App\Repositories;

use App\Models\BannerAnalyticDetails;
use Illuminate\Http\Response;
use Carbon\Carbon;

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
        return $this->model->selectRaw('action_type, count(distinct id) total_count, banner_analytic_id')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('action_type', 'banner_analytic_id')
            ->orderBy('banner_analytic_id', 'ASC')
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
}
