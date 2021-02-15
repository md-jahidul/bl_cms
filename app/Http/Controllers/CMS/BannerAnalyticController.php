<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BannerAnalyticService;

class BannerAnalyticController extends Controller
{
    /**
     * @var BannerAnalyticService
     */
    protected $bannerAnalyticService;

    /**
     * BannerAnalyticController constructor.
     * @param BannerAnalyticService $bannerAnalyticService
     */
    public function __construct(BannerAnalyticService $bannerAnalyticService)
    {
        $this->bannerAnalyticService = $bannerAnalyticService;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (($request->has('searchByFromdate') && !empty($request->input('searchByFromdate'))) && ($request->has('searchByTodate') && !empty($request->input('searchByTodate')))) {
                return $this->bannerAnalyticService->bannerAnaliticReporFilterData($request);
            }
            return $this->bannerAnalyticService->bannerAnaliticReportData($request);
        }
        return view('admin.banner-analytic.index');
    }

    /**
     * @param null $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */

    public function detailreport($id = null, Request $request)
    {
        $from = ($request->has('from')) ? $request->input('from') : null;
        $to = ($request->has('to')) ? $request->input('to') : null;
        if ($request->ajax()) {
            return $this->bannerAnalyticService->bannerAnaliticDetailReportData($id, $request);
        }
        $deeplinkId = $id;
        return view('admin.banner-analytic.details', compact('deeplinkId', 'from', 'to'));
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param Request $request
     * @return void
     */
    public function purchaseDetailreport($id = null, Request $request)
    {
        $from = ($request->has('from')) ? $request->input('from') : null;
        $to = ($request->has('to')) ? $request->input('to') : null;
        if ($request->ajax()) {
            return $this->bannerAnalyticService->bannerAnaliticPurchaseDetailReportData($id, $request);
        }
        $purchasesId = $id;
        return view('admin.banner-analytic.purchase_details', compact('purchasesId', 'from', 'to'));
    }
}
