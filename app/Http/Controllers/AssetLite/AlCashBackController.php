<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlCashBackService;
// use App\Services\ProductCoreService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AlCashBackController extends Controller
{
    /**
     * @var AlCashBackService
     */
    private $alCashBackService;
    /**
     * @var ProductCoreService
     */
    // private $productCoreService;

    /**
     * AlCashBackController constructor.
     * @param AlCashBackService $alCashBackService
     * @param ProductCoreService $productCoreService
     */
    public function __construct(
        AlCashBackService $alCashBackService
        // ProductCoreService $productCoreService
    ) {
        $this->alCashBackService = $alCashBackService;
        // $this->productCoreService = $productCoreService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cashBackCampaigns = $this->alCashBackService->findAll();
        return view('admin.al-campaign.cash-back.index', compact('cashBackCampaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        // $products = $this->productCoreService->findAll();
        $baseMsisdnGroups = $this->alCashBackService->findAll();
        // return view('admin.al-campaign.cash-back.create-edit', compact('products', 'baseMsisdnGroups'));
        return view('admin.al-campaign.cash-back.create-edit', compact('baseMsisdnGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->alCashBackService->storeCampaign($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('al-cash-back-campaign.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        // $products = $this->productCoreService->findAll();
        $campaign = $this->alCashBackService->findOne($id);
        // return view('admin.al-campaign.cash-back.create-edit', compact('products', 'campaign'));
        return view('admin.al-campaign.cash-back.create-edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->alCashBackService->updateCampaign($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('al-cash-back-campaign.index'));
    }


    /**
     * @param $id
     * @return Application|UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->alCashBackService->deleteCampaign($id);
        return url('al-cash-back-campaign');
    }
}
