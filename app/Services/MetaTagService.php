<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\MetaTagRepository;
use App\Repositories\QuickLaunchRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class MetaTagService
{
    use CrudTrait;

    /**
     * @var MetaTagRepository
     */
    protected $metaTagRepository;

    /**
     * MetaTagService constructor.
     * @param MetaTagRepository $metaTagRepository
     */
    public function __construct(MetaTagRepository $metaTagRepository)
    {
        $this->metaTagRepository = $metaTagRepository;
        $this->setActionRepository($metaTagRepository);
    }

    public function findMetaTag($id)
    {
        return $this->metaTagRepository->metaTag($id);
    }

    public function storeFixedPageTag($data)
    {
        $data['page_id'] = 0;
        $this->save($data);
        return Response('Fixed page tag add successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateMetaTag($data, $id)
    {
        $metaTag = $this->findOne($id);
        $metaTag->update($data);
        return Response('Meta tag updated successfully');
    }

    public function deleteFixedPage($id)
    {
        $fixedPage = $this->findOne($id);
        $fixedPage->delete();
        return Response("Fixed page delete successfully!");
    }
}
