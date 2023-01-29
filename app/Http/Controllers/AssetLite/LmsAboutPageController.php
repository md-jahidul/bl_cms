<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\ComponentHelper;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\AboutPageService;
use App\Services\AlBannerService;
use App\Services\Assetlite\ComponentService;
use App\Services\EthicsService;
use App\Services\LmsAboutBannerService;
use App\Services\LmsBenefitService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LmsAboutPageController extends Controller
{
    /**
     * @var AboutPageService
     */
    private $aboutPageService;
    /**
     * @var LmsBenefitService
     */
    private $lmsBenefitService;
    /**
     * @var ComponentService
     */
    private $componentService;

    protected const PAGE_TYPE = "about_loyalty";
    /**
     * @var LmsAboutBannerService
     */
    private $lmsAboutBannerService;

    protected $alBannerService;


    /**
     * EthicsController constructor.
     * @param AboutPageService $aboutPageService
     * @param LmsBenefitService $lmsBenefitService
     */
    public function __construct(
        AboutPageService $aboutPageService,
        LmsBenefitService $lmsBenefitService,
        ComponentService $componentService,
        LmsAboutBannerService $lmsAboutBannerService,
        AlBannerService $alBannerService
    ) {
        $this->aboutPageService = $aboutPageService;
        $this->lmsBenefitService = $lmsBenefitService;
        $this->componentService = $componentService;
        $this->lmsAboutBannerService = $lmsAboutBannerService;
        $this->alBannerService = $alBannerService;

    }

    /**
     * Display page info and list of files
     *
     * @param No
     * @return Factory|View|Application
     */
    public function index($slug)
    {
        
        /**
         * shuvo-bs
         * We have Plan to merge all the banner in the al_banners table. For this reason we have store discount-privilege's banner in al_banner table
         */
        if ($slug == 'discount-privilege') {

            // $details = $this->aboutPageService->findAboutDetail($slug);
            // $benefits = $this->lmsBenefitService->getBenefit($slug);
            $banner = $this->alBannerService->findBanner('discount_privilege', 0)??null;

            // dd($aboutLoyaltyBanner);
            // $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
            // $components = $this->componentService->findBy(['page_type' => 'about_loyalty'], '', $orderBy);
            return view('admin.loyalty.about-pages.discount-privilege', compact('banner'));

        } else {
            // $details = $this->aboutPageService->findAboutDetail($slug);
            // $benefits = $this->lmsBenefitService->getBenefit($slug);
            $aboutLoyaltyBanner = $this->lmsAboutBannerService->getBannerImgByPageType('about_loyalty');
            // dd($aboutLoyaltyBanner);
            $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
            $components = $this->componentService->findBy(['page_type' => 'about_loyalty'], '', $orderBy);
            return view('admin.loyalty.about-pages.index', compact('components', 'aboutLoyaltyBanner'));
        }
        
    }

    public function componentCreate()
    {
        $componentList = ComponentHelper::components();
        return view('admin.components.create', compact('componentList'));
    }

    public function componentStore(Request $request)
    {
        $response = $this->componentService->componentStore($request->all(), 0, self::PAGE_TYPE);
        Session::flash('success', $response->getContent());
        return redirect('about-page/priyojon');
    }

    public function componentEdit(Request $request, $id)
    {
        $component = $this->componentService->findOne($id);
        $componentList = ComponentHelper::components();
        return view('admin.components.create', compact('component', 'componentList'));
    }

    public function componentUpdate(Request $request, $id)
    {
        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('about-page/priyojon');
    }

    public function componentSortable(Request $request): Response
    {
        return $this->componentService->tableSortable($request->all());
    }

    public function componentDestroy($id)
    {
        $this->componentService->deleteComponent($id);
        return url('about-page/priyojon');
    }

    /**
     * @param $slug
     * @return Factory|View
     */
    public function aboutPageView($slug)
    {
        $details = $this->aboutPageService->findAboutDetail($slug);
        return view('admin.loyalty.about-pages.about_page', compact('slug', 'details'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function aboutPageUpdate(Request $request)
    {
        $response = $this->aboutPageService->updateAboutPage($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('about-page', $request->slug));
    }


    /**
     * Update category
     *
     * @param Request $request
     * @return JsonResponse|Application|RedirectResponse|Redirector
     * @Dev Bulbul Mahmud Nito || 20/03/2020
     */
    public function updatePageInfo(Request $request)
    {
        $response = $this->lmsBenefitService->updatePageInfo($request);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Page info is updated!');
        } else {
            Session::flash('error', 'Page info updating process failed!');
        }
        return redirect('/ethics-compliance');
    }

    /**
     * Save ethics file
     *
     * @param Request $request
     * @return JsonResponse|Application|RedirectResponse|Redirector
     * @Dev Bulbul Mahmud Nito || 22/06/2020
     */
    public function saveBenefit(Request $request)
    {
        $response = $this->lmsBenefitService->saveBenefit($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'File saved!');
        } else {
            Session::flash('error', 'File saving process failed!');
        }
        return redirect("/about-page/$request->page_type");
    }


    /**
     * File Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 22/06/2020
     */
    public function sortFiles(Request $request)
    {
        return $this->lmsBenefitService->changeFileSort($request);
    }

    /**
     * File status Change.
     *
     * @param  $fileId
     * @return Response
     * @Dev Bulbul Mahmud Nito || 22/06/2020
     */
    public function chanbgeStatus($fileId)
    {
        return $this->lmsBenefitService->changeFileStatus($fileId);
    }

    /**
     * Get single file"s data
     *
     * @param $id
     * @return Model
     * @Dev Bulbul Mahmud Nito || 24/06/2020
     */
    public function benefitEdit($id)
    {
        return $this->lmsBenefitService->findOne($id);
    }

    /**
     * file delete.
     *
     * @param $fileId
     * @return JsonResponse|Application|RedirectResponse|Redirector
     * @Dev Bulbul Mahmud Nito || 24/06/2020
     */
    public function fileDelete($slug, $fileId)
    {
        $response = $this->lmsBenefitService->deleteEthicsFile($fileId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'File is deleted!');
        } else {
            Session::flash('error', 'File deleting process failed!');
        }
        return redirect("/about-page/$slug");
    }

    public function bannerUpload(Request $request)
    {
        $response = $this->lmsAboutBannerService->bannerImageUpload($request->all());
        Session::flash('message', $response->getContent());
        return redirect('about-page/priyojon');
    }
}
