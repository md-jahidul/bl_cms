<?php


namespace App\Repositories;


use App\Models\AgentDeeplink;
use Illuminate\Http\Response;

class AgentDeepLinkRepository extends BaseRepository
{
    public $modelName = AgentDeeplink::class;

    /**
     * @param $id
     * @return mixed
     */
    public function findDeeplinkById($id)
    {
        return $this->model->where('agent_id', $id)->where('is_delete', 0)->orderBy('id', 'desc')->get();
    }

    /**
     * @param $id
     * @return Response
     */
    public function agentDeeplinkSoftDelete($id)
    {
        $result = $this->model->find($id);
        $result->is_delete = 1;
        if ($result->save()) {
            return new Response("Agent DeepLink has been successfully deleted");
        } else {
            return new Response("Something is wrong");
        }

    }

}
