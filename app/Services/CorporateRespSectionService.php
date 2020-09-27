<?php

namespace App\Services;

use App\Repositories\AlSliderRepository;
use App\Repositories\CorporateRespSectionRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class CorporateRespSectionService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var CorporateRespSectionRepository
     */
    private $corpRespSection;

    /**
     * AlSliderService constructor.
     * @param CorporateRespSectionRepository $corporateRespSectionRepository
     */
    public function __construct(CorporateRespSectionRepository $corporateRespSectionRepository)
    {
        $this->corpRespSection = $corporateRespSectionRepository;
        $this->setActionRepository($corporateRespSectionRepository);
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateCorpRespSection($data, $id)
    {
        $section = $this->findOne($id);
        $directory = 'assetlite/images/corporate-responsibility';

        if (request()->hasFile('banner_image_url')) {
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], $directory);
            $this->deleteFile($section->banner_image_url);
        }

        if (request()->hasFile('banner_mobile_view')) {
            $data['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], $directory);
            $this->deleteFile($section->banner_mobile_view);
        }

        $section->update($data);
        return Response('Section update successfully !');
    }

}
