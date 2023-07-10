<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\MediaTvcVideoRepository;
use App\Services\AlFaqService;
use App\Services\FourGCampaignService;
use App\Services\FourGLandingPageService;
use App\Services\MediaBannerImageService;
use App\Services\MediaLandingPageService;
use App\Services\MediaPressNewsEventService;
use App\Services\MediaTvcVideoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Self_;

class FourGLandingPageController extends Controller
{
    /**
     * @var FourGLandingPageService
     */
    private $fourGLandingPageService;
    /**
     * @var FourGCampaignService
     */
    private $fourGCampaignService;

    /**
     * RolesController constructor.
     * @param FourGLandingPageService $fourGLandingPageService
     * @param FourGCampaignService $fourGCampaignService
     */
    public function __construct(
        FourGLandingPageService $fourGLandingPageService,
        FourGCampaignService $fourGCampaignService
    ) {
        $this->fourGLandingPageService = $fourGLandingPageService;
        $this->fourGCampaignService = $fourGCampaignService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $componentList = $this->fourGLandingPageService->findWithoutBanner();
        $bannerImage = $this->fourGLandingPageService->getBannerImage();
        $pageType = 'banglalink-4g';
        return view('admin.banglalink-4g.landing-page.component_list', compact('componentList', 'bannerImage', 'pageType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.media.landing-page.component_create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $component = $this->fourGLandingPageService->findOne($id);
        return view('admin.banglalink-4g.landing-page.component_edit', compact('component'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->fourGLandingPageService->updateComponent($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('bl-4g-landing-page');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function bannerUpload(Request $request)
    {
        $response = $this->fourGLandingPageService->bannerImageUpload($request->all());
        Session::flash('message', $response->getContent());
        return redirect('bl-4g-landing-page');
    }
}
