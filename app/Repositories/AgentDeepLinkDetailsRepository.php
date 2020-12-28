<?php


namespace App\Repositories;


use App\Models\AgentDeeplinkDetail;
use Illuminate\Http\Response;

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



}
