<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\SitemapService;

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
        $this->sitemapService->generateSitemapFile();
        dd('success');
    }
}
