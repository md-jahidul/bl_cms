<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\MediaNewsCategoryRepository;
use App\Repositories\MediaPressNewsEventRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Error;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MediaNewsCategoryService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $sliderRepository
     */
    protected $mediaNewsCategoryRepository;
    /**
     * @var $sliderRepository
     */
    protected $mediaPressNewsEventRepository;

    /**
     * DigitalServicesService constructor.
     * @param MediaNewsCategoryRepository $mediaNewsCategoryRepository
     */
    public function __construct(MediaNewsCategoryRepository $mediaNewsCategoryRepository,MediaPressNewsEventRepository $mediaPressNewsEventRepository)
    {
        $this->mediaNewsCategoryRepository = $mediaNewsCategoryRepository;
        $this->mediaPressNewsEventRepository = $mediaPressNewsEventRepository;
        $this->setActionRepository($mediaNewsCategoryRepository);
    }

    /**
     * Storing the Media News Category
     * @param $data
     * @return Response
     */
    public function storeCategory($data)
    {
        $this->save($data);
        return new Response("Item has been successfully created");
    }

    /**
     * Updating the Media News Category
     * @param $data
     * @return Response
     */
    public function updateCategory($data, $id)
    {
        $mediaNewsCategory = $this->findOne($id);
        $mediaNewsCategory->update($data);
        return Response('Update successfully!');
    }


    /**
     * @param $id
     * @return ResponseFactory|Response
     */
    public function deleteCategory($id)
    {
        $mediaNewsCategory = $this->findOne($id);
        $mediaPressNewsEvent = $this->mediaPressNewsEventRepository->findBy(['media_news_category_id'=>$id]);
        $mediaNewsCategory->delete();
    }
}
