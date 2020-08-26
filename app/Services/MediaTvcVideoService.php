<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Repositories\MediaPressNewsEventRepository;
use App\Repositories\MediaTvcVideoRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MediaTvcVideoService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $mediaTvcVideoRepository;

    /**
     * DigitalServicesService constructor.
     * @param MediaTvcVideoRepository $mediaTvcVideoRepository
     */
    public function __construct(MediaTvcVideoRepository $mediaTvcVideoRepository)
    {
        $this->mediaTvcVideoRepository = $mediaTvcVideoRepository;
        $this->setActionRepository($mediaTvcVideoRepository);
    }

    /**
     * Storing the alFaq resource
     * @param $data
     * @return Response
     */
    public function storeTvcVideo($data)
    {
        $this->save($data);
        return new Response("TVC video has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateTvcVideo($data, $id)
    {
        $mediaTvcVideo = $this->findOne($id);

        $dirPath = 'assetlite/images/media';
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], $dirPath);
            $this->deleteFile($mediaTvcVideo->image_url);
        }
        unset($data['files']);
        $mediaTvcVideo->update($data);
        return Response('Faq has been successfully updated');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteTvcVideo($id)
    {
        $mediaTvcVideo = $this->findOne($id);
        $mediaTvcVideo->delete();
        return Response('Item has been successfully deleted');
    }
}
