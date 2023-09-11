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
use App\Repositories\SearchableDataRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SitemapService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var SearchableDataRepository
     */
    private $searchableDataRepository;

    /**
     * SitemapService constructor.
     * @param SearchableDataRepository $searchableDataRepository
     */
    public function __construct(
        SearchableDataRepository $searchableDataRepository
    ) {
        $this->searchableDataRepository = $searchableDataRepository;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function generateSitemapFile()
    {
        $date = Carbon::now()->toDateString();
        $urls = '';
        // All Details Page URL
        $searchableData = $this->searchableDataRepository->findByProperties(['status' => 1], ['url_slug_en', 'url_slug_bn']);
        foreach ($searchableData as $item) {
            if ($item->url_slug_en != $item->url_slug_bn){
                $urls .= $this->urlTag($item, $date);
            }
        }


        // Product Category

        $sitemapTags =
        '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">&lt';
        $sitemapTags .= $urls;
        $sitemapTags .= "
</urlset>";


        Storage::disk("local")->put('example.txt', $sitemapTags);
    }

    public function urlTag($item, $date): string
    {
        return "
    <url>
        <loc>https://www.banglalink.net/en/$item->url_slug_en</loc>
        <lastmod>$date</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://www.banglalink.net/bn/$item->url_slug_bn</loc>
        <lastmod>$date</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>";
    }
}
