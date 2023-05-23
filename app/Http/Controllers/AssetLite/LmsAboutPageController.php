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
use App\Services\PriyojonService;
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

    private $priyojonService;



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
        PriyojonService $priyojonService,
        AlBannerService $alBannerService
    ) {
        $this->aboutPageService = $aboutPageService;
        $this->lmsBenefitService = $lmsBenefitService;
        $this->componentService = $componentService;
        $this->lmsAboutBannerService = $lmsAboutBannerService;
        $this->alBannerService = $alBannerService;
        $this->priyojonService = $priyojonService;

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
        if ($slug == 'benefits-for-you' ) {

            $priyojonLanding = $this->priyojonService->getPriyojonByType('benefits_for_you');
            $banner = $this->alBannerService->findBanner('benefits_for_you', 0)??null;

            return view('admin.loyalty.about-pages.benefits-for-you', compact('priyojonLanding','banner'));

        }else if ($slug == 'discount-privilege') {

            // $details = $this->aboutPageService->findAboutDetail($slug);
            // $benefits = $this->lmsBenefitService->getBenefit($slug);
            $priyojonLanding = $this->priyojonService->getPriyojonByType('discount_privilege');
            $banner = $this->alBannerService->findBanner('discount_privilege', 0)??null;

            // dd($aboutLoyaltyBanner);
            // $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
            // $components = $this->componentService->findBy(['page_type' => 'about_loyalty'], '', $orderBy);
            return view('admin.loyalty.about-pages.discount-privilege', compact('priyojonLanding','banner'));

        }else {
            // $details = $this->aboutPageService->findAboutDetail($slug);
            // $benefits = $this->lmsBenefitService->getBenefit($slug);
            $aboutLoyaltyBanner = $this->lmsAboutBannerService->getBannerImgByPageType('about_loyalty');

            $searchTag = $aboutLoyaltyBanner->searchableFeature()->first();
            $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
            $components = $this->componentService->findBy(['page_type' => 'about_loyalty'], '', $orderBy);
            $priyojonMenu = $this->priyojonService->findByAlias("about-priyojon");
            return view('admin.loyalty.about-pages.index', compact('components', 'aboutLoyaltyBanner', 'searchTag', 'priyojonMenu'));
        }

    }

    public function componentCreate()
    {
        $componentList = ComponentHelper::components()['all'];
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
        $componentList = ComponentHelper::components()['all'];
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
        $request->validate([
            'left_img_name_en' => 'unique:about_pages,left_img_name_en,' . $request->about_page_id,
            'left_img_name_bn' => 'unique:about_pages,left_img_name_bn,' . $request->about_page_id,
            'right_img_name_en' => 'unique:about_pages,right_img_name_en,' . $request->about_page_id,
            'right_img_name_bn' => 'unique:about_pages,right_img_name_bn,' . $request->about_page_id,
        ]);

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
     * @return Application|Redirector|RedirectResponse
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
