<?php


namespace App\Services;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Models\AgentList;
use App\Repositories\AgentRepository;

class AgentService
{

    use CrudTrait;

    /**
     * @var $agentRepository
     */
    protected $agentRepository;

    /**
     * AgentService constructor.
     * @param AgentRepository $agentRepository
     */
    public function __construct(AgentRepository $agentRepository)
    {
        $this->agentRepository = $agentRepository;
        $this->setActionRepository($agentRepository);
    }


    public  function agentList(){
       return AgentList::where('is_delete',0)->get();
    }

    public  function upateAgentInformation($request,$id){

        $search = $this->findOne($id);
        $search->update($request);
        return Response('Agent Information has been successfully updated');

//        $search= $agentList->find($id);
//        $search->name=$request->input('name');
//        $search->msisdn=$request->input('msisdn');
//        $search->email=$request->input('email');
//        $search->address=$request->input('address');
//        $search->is_active=$request->input('is_active');
//        if($search->save()){
//            echo 'ok';
//            session()->flash('success', 'Agent information has been successfully updated ');
//
//        }else{
//            session()->flash('warning', 'Something went wrong try again later');
//
//        }
    }

    public function upateAgentStatus($id){
        $search = $this->findOne($id);
        $status=($search->is_active==1)?0:1;
//        $search->is_active=$search;
        $search->update(['is_active'=>trim($status)]);
        return Response('Agent status has been successfully updated');
    }

}
