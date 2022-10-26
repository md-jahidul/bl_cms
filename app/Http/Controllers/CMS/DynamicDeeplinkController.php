<?php

namespace App\Http\Controllers\CMS;

use App\Models\AgentList;
use App\Models\AgentDeeplinkDetail;
use App\Models\MyBlInternetOffersCategory;
use App\Repositories\ContentDeeplinkRepository;
use App\Repositories\MyblManageItemRepository;
use App\Services\CommerceBillCategoryService;
use App\Services\CommerceBillUtilityService;
use App\Services\DynamicDeeplinkService;
use App\Services\FeedCategoryService;
use App\Services\MyblAppMenuService;
use App\Services\MyBlInternetOffersCategoryService;
use App\Services\MyblManageService;
use App\Services\NewCampaignModality\MyBlCampaignSectionService;
use App\Services\StoreCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Http\Requests\AgentDeeplinkRequest;
use Illuminate\View\View;
use Redirect;
use App\Services\AgentService;
use Mail;

class DynamicDeeplinkController extends Controller
{
    /**
     * @var DynamicDeeplinkService
     */
    private $dynamicDeeplinkService;

    protected const STORE = 'store';
    protected const FEED = 'feed';
    protected const INTERNET_PACK = 'internet_pack';
    protected const MyBlCampaignSection = 'mybl_campaign';
    protected const Content = 'content';
    protected const CommerceBillCategory = 'bill_category';
    protected const CommerceBillUtility = 'bill_utility';
    protected const OTHER = 'others';
    /**
     * @var MyBlInternetOffersCategoryService
     */
    private $internetOffersCategoryService;
    /**
     * @var StoreCategoryService
     */
    private $storeCategoryService;
    /**
     * @var FeedCategoryService
     */
    private $feedCategoryService;
    /**
     * @var MyblAppMenuService
     */
    private $appMenuService;
    /**
     * @var MyblManageItemRepository
     */
    private $manageItemRepository;
    /**
     * @var MyBlCampaignSectionService
     */
    private $myBlCampaignSectionService, $commerceBillCategoryService, $commerceBillUtilityService, $contentDeeplinkRepository;
    /**
     * DynamicDeeplinkService constructor.
     * @param DynamicDeeplinkService $dynamicDeeplinkService
     */
    public function __construct(
        DynamicDeeplinkService $dynamicDeeplinkService,
        MyBlInternetOffersCategoryService $internetOffersCategoryService,
        FeedCategoryService $feedCategoryService,
        StoreCategoryService $storeCategoryService,
        MyblAppMenuService $appMenuService,
        MyblManageItemRepository $manageItemRepository,
        MyBlCampaignSectionService $myBlCampaignSectionService,
        CommerceBillCategoryService $commerceBillCategoryService,
        CommerceBillUtilityService $commerceBillUtilityService,
        ContentDeeplinkRepository $contentDeeplinkRepository
    ) {
        $this->dynamicDeeplinkService = $dynamicDeeplinkService;
        $this->internetOffersCategoryService = $internetOffersCategoryService;
        $this->feedCategoryService = $feedCategoryService;
        $this->storeCategoryService = $storeCategoryService;
        $this->appMenuService = $appMenuService;
        $this->manageItemRepository = $manageItemRepository;
        $this->myBlCampaignSectionService = $myBlCampaignSectionService;
        $this->commerceBillCategoryService = $commerceBillCategoryService;
        $this->commerceBillUtilityService = $commerceBillUtilityService;
        $this->contentDeeplinkRepository = $contentDeeplinkRepository;
        $this->middleware('auth');
    }

    public function analyticData()
    {
        $analytics = $this->dynamicDeeplinkService->analyticData();
        return view('admin.deep-link-analytic.list', compact('analytics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function storeDeepLinkCreate(Request $request)
    {
        $storeCat = $this->storeCategoryService->findOne($request->id);
        return $this->dynamicDeeplinkService->generateDeeplink(self::STORE, $storeCat, $request);
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function feedDeepLinkCreate(Request $request)
    {
        $feedCat = $this->feedCategoryService->findOne($request->id);
        return $this->dynamicDeeplinkService->generateDeeplink(self::FEED, $feedCat, $request);
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function internetPackDeepLinkCreate(Request $request)
    {
        $internetCat = $this->internetOffersCategoryService->findOne($request->id);
        return $this->dynamicDeeplinkService->generateDeeplink(self::INTERNET_PACK, $internetCat, $request);
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function menuDeepLinkCreate(Request $request)
    {
        $menu = $this->appMenuService->findOne($request->id);
        return $this->dynamicDeeplinkService->generateDeeplink(self::OTHER, $menu, $request);
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function manageDeepLinkCreate(Request $request)
    {
        $manage = $this->manageItemRepository->findOne($request->id);
        return $this->dynamicDeeplinkService->generateDeeplink(self::OTHER, $manage, $request);
    }

    public  function myblCampaignSectionDeepLinkCreate(Request $request)
    {
        $section = $this->myBlCampaignSectionService->findOne($request->id);

        return $this->dynamicDeeplinkService->generateDeeplink(self::MyBlCampaignSection, $section, $request);
    }

    public  function commerceBillCategoryDeepLinkCreate(Request $request)
    {
        $billCategory = $this->commerceBillCategoryService->findOne($request->id);

        return $this->dynamicDeeplinkService->generateDeeplink(self::CommerceBillCategory, $billCategory, $request);
    }

    public  function commerceBillUtilityDeepLinkCreate(Request $request)
    {
        $billUtility = $this->commerceBillUtilityService->findOne($request->id);

        return $this->dynamicDeeplinkService->generateDeeplink(self::CommerceBillUtility, $billUtility, $request);
    }

    public function contentDeepLinkCreate(Request  $request)
    {
        $contentData = $this->contentDeeplinkRepository->findOne($request->id);

        $sectionType = self::Content;
        if ($contentData->category_name == 'courses') {
            $sectionType = 'course';
        }

        return $this->dynamicDeeplinkService->generateDeeplink($sectionType, $contentData, $request);
    }
}
