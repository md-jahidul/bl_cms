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
use Carbon\Carbon;
use Illuminate\Http\Response;

class AlSiteMapService
{
    use CrudTrait;

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

//    public function robotTxt()
//    {
//        return $this->alSiteMapRepository->Data();
//    }

    public function findByTagType($type)
    {
        return $this->alSiteMapRepository->findOneByProperties(['tag_type' => $type]);
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function siteMapUpdateOrCreate($data)
    {
//        request()->validate([
//            'txt' => 'required'
//        ]);


        $urlSet = $this->findByTagType('url_set');

        $parentTag['url_set'] = $data['url_set'];
        $parentTag['tag_type'] = 'url_set';


        if ($urlSet) {
            $urlSet->update($parentTag);
        } else {
            $this->save($parentTag);
        }

        $this->alSiteMapRepository->deleteTagType('url');
        foreach ($data['loc'] as $key => $items) {
            $subTag['tag_type'] = "url";
            $subTag['loc'] = $items;
            $subTag['change_freq'] = $data['change_freq'][$key];
            $subTag['priority'] = $data['priority'][$key];
            $subTag['last_mod'] = date('Y-m-d');
            $this->save($subTag);
        }
        return Response('Robots txt has been successfully updated');
    }
}
