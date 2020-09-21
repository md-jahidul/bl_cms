<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\MediaTvcVideoRepository;
use App\Services\AlFaqService;
use App\Services\BanglalinkThreeGService;
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

class BanglalinkThreeGController extends Controller
{
    /**
     * @var BanglalinkThreeGService
     */
    private $banglalinkThreeGService;

    /**
     * RolesController constructor.
     * @param BanglalinkThreeGService $banglalinkThreeGService
     */
    public function __construct(
        BanglalinkThreeGService $banglalinkThreeGService
    ) {
        $this->banglalinkThreeGService = $banglalinkThreeGService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $componentList = $this->banglalinkThreeGService->findWithoutBanner();
        $bannerImage = $this->banglalinkThreeGService->getBannerImage();
        return view('admin.banglalink-3g.landing-page', compact('componentList', 'bannerImage'));
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
        $component = $this->banglalinkThreeGService->findOne($id);
        return view('admin.banglalink-3g.component_edit', compact('component'));
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
        $response = $this->banglalinkThreeGService->updateComponent($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('bl-3g-landing-page');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function bannerUpload(Request $request)
    {
        $response = $this->banglalinkThreeGService->bannerImageUpload($request->all());
        Session::flash('message', $response->getContent());
        return redirect('bl-3g-landing-page');
    }
}
