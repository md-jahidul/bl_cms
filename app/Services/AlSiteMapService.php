<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlRobotsRepository;
use App\Repositories\AlSiteMapRepository;
use App\Repositories\AmarOfferRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AlSiteMapService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var AlSiteMapRepository
     */
    private $alSiteMapRepository;

    /**
     * AlRobotsRepository constructor.
     * @param AlSiteMapRepository $alSiteMapRepository
     */
    public function __construct(AlSiteMapRepository $alSiteMapRepository)
    {
        $this->alSiteMapRepository = $alSiteMapRepository;
        $this->setActionRepository($alSiteMapRepository);
    }

    public function getSiteMapData()
    {
        return $this->alSiteMapRepository->siteMapData();
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function siteMapUpdateOrCreate($data)
    {
        request()->validate([
            'data' => 'required'
        ]);

        $this->deleteFile('assetlite/server-files/sitemap.xml');
        $this->makeFile('assetlite/server-files/sitemap.xml', $data['data']);

        $siteMap = $this->alSiteMapRepository->siteMapData();
        if ($siteMap) {
            $data['updated_by'] = Auth::id();
            $siteMap->update($data);
        } else {
            $data['created_by'] = Auth::id();
            $this->save($data);
        }

        return Response('Site map has been successfully updated');
    }

    /**
     * @return array
     */
    public function copyInRootDirectory(): array
    {

        $output = null;
        $retVal = null;

        if(env('APP_ENV') == "production") {

            $source1 = env('SRC_DIRECTORY1');
            $destination1 = env('DST_DIRECTORY1');

            $source2 = env('SRC_DIRECTORY2');
            $destination2 = env('DST_DIRECTORY2');

            $source3 = env('SRC_DIRECTORY3');
            $destination3 = env('DST_DIRECTORY3');

            exec('cp'." ".$source1.'sitemap.xml'." ".$destination1, $output, $retVal);

            exec('cp'." ".$source2.'sitemap.xml'." ".$destination2, $output, $retVal);

            exec('cp'." ".$source3.'sitemap.xml'." ".$destination3, $output, $retVal);

            return array($output, $retVal);

        } else {

            $source = env('SRC_DIRECTORY1');
            $destination = env('DST_DIRECTORY1');

            exec('cp'." ".$source.'sitemap.xml'." ".$destination, $output, $retVal);

            return array($output, $retVal);
        }
    }
}
