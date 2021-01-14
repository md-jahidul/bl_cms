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
        $retval = null;

        $source = env('SRC_DIRECTORY');
        $destination = env('DST_DIRECTORY');

        exec('cp'." ".$source.'sitemap.xml'." ".$destination, $output, $retval);

        return array($output, $retval);
    }
}
