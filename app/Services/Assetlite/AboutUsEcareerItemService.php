<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\AboutUsEcareerItemRepository;
use App\Repositories\AboutUsRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class AboutUsEcareerItemService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var AboutUsEcareerItemRepository
     */
    private $aboutUsEcareerItemRepository;

    /**
     * AboutUsService constructor.
     * @param AboutUsEcareerItemRepository $aboutUsEcareerItemRepository
     */
    public function __construct(AboutUsEcareerItemRepository $aboutUsEcareerItemRepository)
    {
        $this->aboutUsEcareerItemRepository = $aboutUsEcareerItemRepository;
        $this->setActionRepository($aboutUsEcareerItemRepository);
    }

    public function aboutCareerItems($careerId)
    {
        return $this->aboutUsEcareerItemRepository->findByProperties(['about_us_ecareers_id' => $careerId]);
    }


    /**
     * @param $request
     * @return Response
     */
    public function storeAboutCareerItems($data, $careerId)
    {
        if (request()->hasFile('image')) {
            $data['image'] = $this->upload($data['image'], 'assetlite/images/about-us/career-item');
        }
        $data['about_us_ecareers_id'] = $careerId;
        $this->save($data);
        return new Response('About career item added successfully');
    }


    /**
     * @param $request
     * @param $aboutUs
     * @return ResponseFactory|Response
     */
    public function updateAboutCareerItems($data, $id)
    {
        $aboutCareerItem = $this->findOne($id);
        if (request()->hasFile('image')) {
            $data['image'] = $this->upload($data['image'], 'assetlite/images/about-us/career-item');
            $this->deleteFile($aboutCareerItem->image);
        }
        $aboutCareerItem->update($data);
        return Response('About career item updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAboutCareerItem($id)
    {
        $aboutCareerItem = $this->findOne($id);
        $this->deleteFile($aboutCareerItem->image);
        $aboutCareerItem->delete();
        return Response('About career item deleted successfully !');
    }
}
