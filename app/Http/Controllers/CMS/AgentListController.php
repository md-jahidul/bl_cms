<?php

namespace App\Http\Controllers\CMS;

use App\Models\AgentList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Http\Requests\AgentDeeplinkRequest;
use Redirect;
use App\Services\AgentService;

class AgentListController extends Controller
{
    /**
     * @var AgentService
     */
    protected $agentService;

    /**
     * AgentListController constructor.
     * @param AgentService $agentService
     */
    public function __construct(AgentService $agentService)
    {
        $this->agentService = $agentService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agent = $this->agentService->agentList();
        return view('admin.agent-deeplink.index', compact('agent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agent-deeplink.create');
    }

    /**
     * @param AgentRequest $request
     */
    public function store(AgentRequest $request)
    {
        $inputData = $request->all();
        AgentList::create($inputData);
        Session()->flash('message', 'Agent Created successfully');
        return redirect(route('deeplink.agent.list'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeStatus($id)
    {
        $response = $this->agentService->upateAgentStatus($id);
        Session()->flash('message', $response->content());
        return redirect(route('deeplink.agent.list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\AgentList $agentList
     * @return \Illuminate\Http\Response
     */
    public function edit($id, AgentList $agentList)
    {
        $search = $agentList->find($id);
        return view('admin.agent-deeplink.edit', compact('search'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\AgentList $agentList
     * @return \Illuminate\Http\Response
     */
    public function update($id, AgentRequest $request, AgentList $agentList)
    {
        $response = $this->agentService->upateAgentInformation($request->all(), $id);
        Session()->flash('message', $response->content());
        return redirect(route('deeplink.agent.list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AgentList $agentList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, AgentList $agentList, Request $request)
    {
        $search = $agentList->find($id);
        $search->is_delete = ($search->is_delete == 1) ? 0 : 1;
        if ($search->save()) {
            session()->flash('success', 'Agent delete has been successfully completed ');
            return Redirect::back();
        } else {
            session()->flash('warning', 'Something went wrong try again later');
            return Redirect::back();
        }

    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewAgentDeeplinkDetails($id = null)
    {
        $agentId = $id;
        if (empty($agentId)) {
            return redirect('deeplink/agent/list');

        }
        $deeplinkTypeList = $this->agentService->deepLinkTypeList();
        $deeplinkList = $this->agentService->getDeepLinkListByAgentId($agentId);
        return view('admin.agent-deeplink.deeplink.list', compact('deeplinkTypeList', 'deeplinkList', 'agentId'));
    }

    /**
     * @param AgentDeeplinkRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function agentDeeplinkStore(AgentDeeplinkRequest $request)
    {
        $id = $request->input('agent_id');
        $response = $this->agentService->storeAgentDeeplink($request->all());
        Session()->flash('message', $response->content());
        return redirect(route('deeplink.agent.deeplink.list', $id));

    }

    /**
     * @param null $agentId
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function agentDeeplinkDelete($agentId = null, $id = null)
    {
        if (empty($agentId) or empty($id)) {
            Session()->flash('message', 'Something is wrong');
            return Redirect::back();
        }
        $response = $this->agentService->agentDeeplinkDeleteById($id);
        Session()->flash('message', $response->content());
        return redirect(route('deeplink.agent.deeplink.list', $agentId));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function agentDeeplinkReport(Request $request)
    {
        if ($request->ajax()) {
            return $this->agentService->agentDeeplinkReportData($request);
        }
        return view('admin.agent-deeplink.report.list');
    }

    /**
     * @param null $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function agentDeeplinkReportDetails($id = null, Request $request)
    {
        if ($request->ajax()) {
            return $this->agentService->agentDeeplinkDetailReportData($id, $request);
        }
        $deeplinkId = $id;
        return view('admin.agent-deeplink.report.details', compact('deeplinkId'));
    }
}
