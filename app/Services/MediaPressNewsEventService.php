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
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MediaPressNewsEventService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $mediaPNERepository;

    /**
     * DigitalServicesService constructor.
     * @param MediaPressNewsEventRepository $mediaPNERepository
     */
    public function __construct(MediaPressNewsEventRepository $mediaPNERepository)
    {
        $this->mediaPNERepository = $mediaPNERepository;
        $this->setActionRepository($mediaPNERepository);
    }

    /**
     * Storing the alFaq resource
     * @param $data
     * @return Response
     */
    public function storePNE($data)
    {
        $data['image_path'] = 'storage/' . $data['image_path']->store('banner');
        $this->save($data);
        return new Response("Banner has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updatePNE($data, $id)
    {
        $faq = $this->findOne($id);
        $data['updated_by'] = Auth::id();
        unset($data['files']);
        $faq->update($data);
        return Response('Faq has been successfully updated');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deletePNE($id)
    {
        $faq = $this->findOne($id);
        $faq->delete();
        return Response('Faq has been successfully deleted');
    }
}
