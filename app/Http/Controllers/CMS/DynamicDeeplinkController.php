<?php

namespace App\Http\Controllers\CMS;

use App\Models\AgentList;
use App\Models\AgentDeeplinkDetail;
use App\Models\MyBlInternetOffersCategory;
use App\Services\DynamicDeeplinkService;
use App\Services\FeedCategoryService;
use App\Services\MyBlInternetOffersCategoryService;
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
     * DynamicDeeplinkService constructor.
     * @param DynamicDeeplinkService $dynamicDeeplinkService
     */
    public function __construct(
        DynamicDeeplinkService $dynamicDeeplinkService,
        MyBlInternetOffersCategoryService $internetOffersCategoryService,
        FeedCategoryService $feedCategoryService,
        StoreCategoryService $storeCategoryService
    ) {
        $this->dynamicDeeplinkService = $dynamicDeeplinkService;
        $this->internetOffersCategoryService = $internetOffersCategoryService;
        $this->feedCategoryService = $feedCategoryService;
        $this->storeCategoryService = $storeCategoryService;
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
}
