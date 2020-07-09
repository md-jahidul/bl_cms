<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class AlFaqService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $alFaqRepository;

    /**
     * DigitalServicesService constructor.
     * @param AlFaqRepository $sliderRepository
     */
    public function __construct(AlFaqRepository $alFaqRepository)
    {
        $this->alFaqRepository = $alFaqRepository;
        $this->setActionRepository($alFaqRepository);
    }

    /**
     * Storing the alFaq resource
     * @return Response
     */
    public function storeAlFaq($data)
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
    public function updateFaq($data, $banner)
    {

        if (isset($data->image_path)) {
            $data = $data->all();
            $data['image_path'] = 'storage/' . $data['image_path']->store('banner');
            unlink($banner->image_path);
            $banner->update($data);
        } else {
            $data->image_path = $banner->image_path;
            $banner->update($data->all());
        }

        return Response('Banner has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteAlFaq($id)
    {
        $banner = $this->findOne($id);
        unlink($banner->image_path);
        $banner->delete();
        return Response('banner has been successfully deleted');
    }
}
