<?php

namespace App\Http\Controllers\CMS;

use App\Models\AgentList;
use App\Models\AgentDeeplinkDetail;
use App\Services\DynamicDeeplinkService;
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
     * DynamicDeeplinkService constructor.
     * @param DynamicDeeplinkService $dynamicDeeplinkService
     */
    public function __construct(DynamicDeeplinkService $dynamicDeeplinkService)
    {
        $this->dynamicDeeplinkService = $dynamicDeeplinkService;
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function storeDeepLinkCreate(Request $request)
    {
        return $this->dynamicDeeplinkService->generateDeeplink(self::STORE, $request);
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function feedDeepLinkCreate(Request $request)
    {
        return $this->dynamicDeeplinkService->generateDeeplink(self::FEED, $request);
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function internetPackDeepLinkCreate(Request $request)
    {
        return $this->dynamicDeeplinkService->generateDeeplink(self::INTERNET_PACK, $request);
    }
}
