<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SitemapService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $prizeService
     */
    protected $aboutPageRepository;

    /**
     * AboutPageService constructor.
     * @param AboutPageRepository $aboutPageRepository
     */
    public function __construct( $aboutPageRepository)
    {
        $this->aboutPageRepository = $aboutPageRepository;
        $this->setActionRepository($aboutPageRepository);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function generateSitemapFile()
    {
        $sitemapTags =
        '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">&lt';


        $sitemapTags .=
'<url>
    <loc>http://www.example.com/</loc>
    <lastmod>2021-07-18</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
</url>';



        $sitemapTags .=
'</urlset>';


        Storage::disk('local')->put('example.txt', $sitemapTags);
    }


}
