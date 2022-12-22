<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\DynamicPageStoreRequest;
use App\Services\Assetlite\ComponentService;
use App\Services\DynamicPageService;
use App\Services\FourGCampaignService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class FourGCampaignController extends Controller
{

    /**
     * @var FourGCampaignService
     */
    private $fourGCampaignService;


    /**
     * DynamicPageController constructor.
     * @param FourGCampaignService $fourGCampaign
     */
    public function __construct(FourGCampaignService $fourGCampaign)
    {
        $this->fourGCampaignService = $fourGCampaign;
    }

    public function index()
    {
        $campaigns = $this->fourGCampaignService->findAll();
        return view('admin.banglalink-4g.campaign.list', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.banglalink-4g.campaign.create-edit');
    }

    public function edit($id)
    {
        $campaign = $this->fourGCampaignService->findOne($id);
        return view('admin.banglalink-4g.campaign.create-edit', compact('campaign'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'image_name_en' => 'unique:four_g_campaigns,image_name_en',
           'image_name_bn' => 'unique:four_g_campaigns,image_name_bn',
        ]);

        $response = $this->fourGCampaignService->storeCampaign($request->all());

        if ($response['success'] == 1) {
            Session::flash('sussess', '4G campaign saved successfully!');
        } else {
            Session::flash('error', $response['message']);
        }

        return redirect('/bl-4g-campaign');
    }

    public function update(Request $request)
    {
        $request->validate([
            'image_name_en' => 'unique:four_g_campaigns,image_name_en,' . $request->id,
            'image_name_bn' => 'unique:four_g_campaigns,image_name_bn,' . $request->id,
        ]);

        $response = $this->fourGCampaignService->updateCampaign($request->all());
        if ($response['success'] == 1) {
            Session::flash('sussess', '4G campaign update successfully!');
        } else {
            Session::flash('error', $response['message']);
        }
        return redirect('/bl-4g-campaign');
    }

    public function destroy($id)
    {
        $response = $this->fourGCampaignService->deleteCampaign($id);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Page is delete!');
        } else {
            Session::flash('error', 'Page deleting process failed!');
        }
        return url('/bl-4g-campaign');
    }
}
