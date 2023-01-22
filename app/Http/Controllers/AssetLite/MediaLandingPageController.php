<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\MediaTvcVideoRepository;
use App\Services\AlFaqService;
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

class MediaLandingPageController extends Controller
{
    /**
     * @var MediaLandingPageService
     */
    private $mediaLandingPageService;
    /**
     * @var MediaBannerImageService
     */
    private $mediaBannerImageService;

    protected const MODULE_TYPE = "landing_page";

    /**
     * RolesController constructor.
     * @param MediaLandingPageService $mediaLandingPageService
     * @param MediaBannerImageService $mediaBannerImageService
     */
    public function __construct(
        MediaLandingPageService $mediaLandingPageService,
        MediaBannerImageService $mediaBannerImageService
    ) {
        $this->mediaLandingPageService = $mediaLandingPageService;
        $this->mediaBannerImageService = $mediaBannerImageService;
    }


    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $orderBy = ['column' => "display_order", 'direction' => 'ASC'];
        $componentList = $this->mediaLandingPageService->findAll('', '', $orderBy);
        $bannerImage = $this->mediaBannerImageService->getBannerImage(self::MODULE_TYPE);
        return view('admin.media.landing-page.component_list', compact('componentList', 'bannerImage'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->mediaLandingPageService->storeComponent($request->all());
        Session::flash('success', $response->getContent());
        return redirect('landing-page-component');
    }

    /**
     * @param $type
     * @return MediaTvcVideoRepository|Collection
     */
    public function itemsFind($type)
    {
        return $this->mediaLandingPageService->mediaItems($type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $component = $this->mediaLandingPageService->findOne($id);
        $multipleItems = $this->mediaLandingPageService->mediaItems($component->component_type);
        return view('admin.media.landing-page.component_edit', compact('component', 'multipleItems'));
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
        $response = $this->mediaLandingPageService->updateComponent($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('landing-page-component');
    }

    public function bannerUpload(Request $request)
    {
        $request->validate([
            'banner_name_en' => 'unique:media_banner_images,banner_name_en,' . $request->ladning_page_id,
            'banner_name_bn' => 'unique:media_banner_images,banner_name_bn,' . $request->ladning_page_id,
        ]);
        $response = $this->mediaBannerImageService->tvcBannerUpload($request->all(), self::MODULE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('landing-page-component');
    }

    public function landingPageSortable(Request $request)
    {
        $this->mediaLandingPageService->tableSortable($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->mediaLandingPageService->deleteComponent($id);
        return url('landing-page-component');
    }
}
