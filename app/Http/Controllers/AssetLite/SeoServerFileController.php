<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;

use App\Models\AmarOfferDetails;
use App\Services\AlHtaccessService;
use App\Services\AlRobotsService;
use App\Services\AlSiteMapService;
use App\Services\AmarOfferDetailsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class SeoServerFileController extends Controller
{
    /**
     * @var AlRobotsService
     */
    private $alRobotsService;
    /**
     * @var AlSiteMapService
     */
    private $alSiteMapService;
    /**
     * @var AlHtaccessService
     */
    private $htaccessService;

    /**
     * AlRobotsService constructor.
     * @param AlHtaccessService $htaccessService
     * @param AlRobotsService $alRobotsService
     * @param AlSiteMapService $alSiteMapService
     */
    public function __construct(
        AlHtaccessService $htaccessService,
        AlRobotsService $alRobotsService,
        AlSiteMapService $alSiteMapService
    ) {
        $this->htaccessService = $htaccessService;
        $this->alRobotsService = $alRobotsService;
        $this->alSiteMapService = $alSiteMapService;
    }

    /**
     * @return Factory|View
     */
    public function getHtaccess()
    {
        $robotsTxt = $this->htaccessService->getHtaccess();
        return view('admin.seo-server-site-files.htaccess.index', compact('robotsTxt'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function updateHtaccess(Request $request)
    {
        $response = $this->htaccessService->updateHtaccess($request->all());
        Session::flash('message', $response->getContent());
        return redirect("htaccess");
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function showRobotsTxt()
    {
        $robotsTxt = $this->alRobotsService->robotTxt();
        return view('admin.seo-server-site-files.robots.index', compact('robotsTxt'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function updateRobotsTxt(Request $request)
    {
        $response = $this->alRobotsService->updateRobotsTxt($request->all());
        Session::flash('message', $response->getContent());

        list($output, $retval) = $this->alRobotsService->copyInRootDirectory();

        return redirect("robot-txt");
    }

    /**
     * @return Factory|View
     */
    public function showSiteMap()
    {
        $siteMap = $this->alSiteMapService->getSiteMapData();
        return view('admin.seo-server-site-files.site-map.index', compact('siteMap'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function siteMapStoreOrUpdate(Request $request)
    {
        $response = $this->alSiteMapService->siteMapUpdateOrCreate($request->all());
        Session::flash('message', $response->getContent());
        return redirect("site-map");
    }


}
