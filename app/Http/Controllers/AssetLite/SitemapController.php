<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\SitemapService;
use Illuminate\Support\Facades\Redis;

class SitemapController extends Controller
{
    /**
     * @var SitemapService
     */
    private $sitemapService;

    /**
     * SitemapController constructor.
     * @param SitemapService $sitemapService
     */
    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    public function showSiteMap()
    {
        return view('admin.sitemap.index');
    }

    public function generateSitemap()
    {
        $response = $this->sitemapService->generateSitemapFile();
        return response()->json($response, 200);
    }
}
