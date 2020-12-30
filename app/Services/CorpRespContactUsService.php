<?php

namespace App\Services;

use App\Repositories\AlSliderRepository;
use App\Repositories\CorporateRespSectionRepository;
use App\Repositories\CorpRespContactUsRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class CorpRespContactUsService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var CorpRespContactUsRepository
     */
    private $corpRespContactUsRepository;

    /**
     * AlSliderService constructor.
     * @param CorpRespContactUsRepository $corpRespContactUsRepository
     */
    public function __construct(CorpRespContactUsRepository $corpRespContactUsRepository)
    {
        $this->corpRespContactUsRepository = $corpRespContactUsRepository;
        $this->setActionRepository($corpRespContactUsRepository);
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updatePage($data, $id)
    {
        $page = $this->findOne($id);
        unset($data['files']);
        $page->update($data);
        return Response('Contact Component Info update successfully !');
    }

}
