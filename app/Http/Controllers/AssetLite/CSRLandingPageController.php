<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\MediaTvcVideoRepository;
use App\Services\AlFaqService;
use App\Services\MediaBannerImageService;
use App\Services\MediaLandingPageService;
use App\Services\MediaPressNewsEventService;
use App\Services\MediaTvcVideoService;
use Doctrine\DBAL\Exception;
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

class CSRLandingPageController extends Controller
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
    protected const REFERENCE_TYPE = "csr";
    protected const LANDING_REFERENCE_TYPE = "csr_landing_page";

    /**
     * @var MediaPressNewsEventService
     */
    private $mediaPressNewsEventService;

    /**
     * RolesController constructor.
     * @param MediaLandingPageService $mediaLandingPageService
     * @param MediaBannerImageService $mediaBannerImageService
     */
    public function __construct(
        MediaPressNewsEventService $mediaPressNewsEventService,
        MediaLandingPageService $mediaLandingPageService,
        MediaBannerImageService $mediaBannerImageService
    ) {
        $this->mediaPressNewsEventService = $mediaPressNewsEventService;
        $this->mediaLandingPageService = $mediaLandingPageService;
        $this->mediaBannerImageService = $mediaBannerImageService;
    }


    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $orderBy = ['column' => "display_order", 'direction' => 'ASC'];
        $componentList = $this->mediaLandingPageService->findBy(['reference_type' => self::LANDING_REFERENCE_TYPE], '', $orderBy);
        return view('admin.al-csr.landing-page.component_list', compact('componentList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $blogPosts = $this->mediaPressNewsEventService->findByReferenceType(self::REFERENCE_TYPE);
        return view('admin.al-csr.landing-page.component_create', compact('blogPosts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->mediaLandingPageService->storeComponent($request->all(), self::LANDING_REFERENCE_TYPE);
        Session::flash('success', $response->getContent());
        return redirect('csr-landing-page-component');
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
        $blogPosts = $this->mediaPressNewsEventService->findByReferenceType(self::REFERENCE_TYPE);
        return view('admin.al-csr.landing-page.component_edit', compact('component', 'blogPosts'));
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
        return redirect('csr-landing-page-component');
    }

    public function bannerUpload(Request $request)
    {
        $response = $this->mediaBannerImageService->tvcBannerUpload($request->all(), self::MODULE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('csr-landing-page-component');
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
        return url('csr-landing-page-component');
    }
}
