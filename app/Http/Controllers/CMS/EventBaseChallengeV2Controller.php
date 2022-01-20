<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventChallengeRequest;
use App\Services\EventBaseBonusChallengeService;
use App\Services\EventBaseBonusV2CampaignService;
use App\Services\ProductCoreService;
use App\Services\TaskServiceV2;
use Illuminate\Support\Facades\Session;
use App\Services\BaseMsisdnService;

class EventBaseChallengeV2Controller extends Controller
{
    private $eventBaseBonusChallengeService;
    private $campaignService;
    private $taskService;
    private $productCoreService;
    private $baseMsisdnService;

    /**
     * @param EventBaseBonusChallengeService $eventBaseBonusChallengeService
     * @param TaskServiceV2 $taskService
     * @param ProductCoreService $productCoreService
     * @param EventBaseBonusV2CampaignService $campaignService
     * @param BaseMsisdnService $baseMsisdnService
     */
    public function __construct(EventBaseBonusChallengeService $eventBaseBonusChallengeService, TaskServiceV2 $taskService, ProductCoreService $productCoreService, EventBaseBonusV2CampaignService $campaignService, BaseMsisdnService $baseMsisdnService)
    {
        $this->middleware('auth');
        $this->eventBaseBonusChallengeService = $eventBaseBonusChallengeService;
        $this->taskService = $taskService;
        $this->campaignService = $campaignService;
        $this->productCoreService = $productCoreService;
        $this->baseMsisdnService = $baseMsisdnService;
    }

    public function index()
    {
        $challenges = $this->eventBaseBonusChallengeService->findAll();

        return view('admin.event-base-bonus.challenges.v2.index', compact('challenges'));
    }

    public function create()
    {
        $tasks = $this->taskService->findAll();
        $products = $this->productCoreService->findAll();
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        return view('admin.event-base-bonus.challenges.v2.create', compact('products', 'tasks', 'baseMsisdnGroups'));
    }

    public function edit($id)
    {
        $tasks = $this->taskService->findAll();
        $product_list = $this->productCoreService->findAll();
        $challenge = $this->eventBaseBonusChallengeService->findOne($id);
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $products = [];

        foreach ($product_list as $key => $value) {
            $products[] = $value['product_code'];
        }

        return view('admin.event-base-bonus.challenges.v2.edit', compact('products', 'tasks', 'challenge', 'baseMsisdnGroups'));
    }

    public function store(StoreEventChallengeRequest $request)
    {
        $response = $this->eventBaseBonusChallengeService->store($request->except('_token'));

        Session::flash('message', 'Campaign Challenge store successful');
        return redirect('/event-base-bonus/v2/challenges');
    }

    public function update(StoreEventChallengeRequest $request, $id)
    {
        $response = $this->eventBaseBonusChallengeService->update($request->except('_token', '_method'), $id);

        Session::flash('message', 'Campaign Challenge store successful');
        return redirect('/event-base-bonus/v2/challenges');
    }

    public function destroy($id)
    {
        $response = $this->eventBaseBonusChallengeService->delete($id);

        Session::flash('message', 'Campaign delete is successful');

        return redirect('/event-base-bonus/v2/challenges');
    }
}
