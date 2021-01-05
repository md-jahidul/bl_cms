<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;

use App\Models\AmarOfferDetails;
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
     * AlRobotsService constructor.
     * @param AlRobotsService $alRobotsService
     * @param AlSiteMapService $alSiteMapService
     */
    public function __construct(
        AlRobotsService $alRobotsService,
        AlSiteMapService $alSiteMapService
    )
    {
        $this->alRobotsService = $alRobotsService;
        $this->alSiteMapService = $alSiteMapService;
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
    public function updateOrCreate(Request $request)
    {
        $response = $this->alRobotsService->updateRobotsTxt($request->all());
        Session::flash('message', $response->getContent());
        return redirect("robot-txt");
    }

    /**
     * @return Factory|View
     */
    public function showSiteMap()
    {
        $parentTag = $this->alSiteMapService->findByTagType('url_set');
        $subTags = $this->alSiteMapService->findBy(['tag_type' => 'url']);
        return view('admin.seo-server-site-files.site-map.index', compact('parentTag', 'subTags'));
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
