<?php

namespace App\Services;

use App\Repositories\AlSliderImageRepository;
use App\Repositories\SliderImageRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class AlSliderImageService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $alSliderImageRepository;

    /**
     * AlSliderImageService constructor.
     * @param SliderImageRepository $alSliderImageRepository
     */
    public function __construct(AlSliderImageRepository $alSliderImageRepository)
    {
        $this->alSliderImageRepository = $alSliderImageRepository;
        $this->setActionRepository($alSliderImageRepository);
    }


    public function itemList($sliderId, $type)
    {
        return $this->alSliderImageRepository->getSliderImage($sliderId, $type);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeSliderImage($data, $sliderId)
    {
        $count = count($this->alSliderImageRepository->findAll());
        $imageUrl = $this->imageUpload($data, 'image_url', $data['title_en'], 'slider-images');
        $data['image_url'] = env('APP_URL', 'http://localhost:8000') . "/slider-images/" . $imageUrl;
        $data['slider_id'] = $sliderId;
        $data['display_order'] = ++$count;
        $this->save($data);
        return new Response('Slider Image added successfully');
    }

    public function tableSortable($data)
    {
        $this->alSliderImageRepository->sliderImageTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateSliderImage($data, $id)
    {
        $sliderImage = $this->findOne($id);
        if (!empty($data['image_url'])) {
            $imageUrl = $this->imageUpload($data, 'image_url', $data['title_en'], 'slider-images');
            $data['image_url'] = env('APP_URL', 'http://localhost:8000') . "/slider-images/" . $imageUrl;
        }
        $sliderImage->update($data);
        return Response('Slider Image update successfully !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteSliderImage($id)
    {
        $sliderImage = $this->findOne($id);
        $sliderImage->delete();
        return Response('Slider Image delete successfully');
    }
}
