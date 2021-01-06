<?php


namespace App\Repositories;


use App\Models\AgentDeeplinkDetail;
use Illuminate\Http\Response;
use Carbon\Carbon;

class AgentDeepLinkDetailsRepository extends BaseRepository
{
    public $modelName = AgentDeeplinkDetail::class;

    /**
     * @param $id
     * @return mixed
     */
    public function findDeeplinkById($id)
    {
        return $this->model->where('agent_deeplink_id', $id)->orderBy('id', 'desc')->get();
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
        return $this->model->selectRaw('action_type, count(distinct id) total_count, agent_deeplink_id')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('action_type', 'agent_deeplink_id')
            ->orderBy('agent_deeplink_id', 'ASC')
            ->get();
    }


}
