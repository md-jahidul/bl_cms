<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\EmergencyBalanceService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AlBannerService;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class EmergencyBalanceController extends Controller
{

    /**
     * @var EmergencyBalanceService
     */
    private $emergencyBalanceService;

    /**
     * @var AlBannerService
     */

    protected $alBannerService;
    protected const PAGE_TYPE = "emergency_balance";


    /**
     * DynamicPageController constructor.
     * @param EmergencyBalanceService $emergencyBalanceService
     * @param AlBannerService $alBannerService
     */
    public function __construct(EmergencyBalanceService $emergencyBalanceService, AlBannerService $alBannerService)
    {
        $this->emergencyBalanceService = $emergencyBalanceService;
        $this->alBannerService = $alBannerService;

    }

    public function index($section_id = 0)
    {
        $banner = $this->alBannerService->findBanner(self::PAGE_TYPE, $section_id);
        $pageType = self::PAGE_TYPE;
        return view('admin.emergency-balance.index', compact('banner', 'pageType'));
    }

}
