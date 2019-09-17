<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 12:37 PM
 */

namespace App\Services;


use App\Repositories\SliderImageRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class SliderImageService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $sliderImageRepository;

    /**
     * SliderImageService constructor.
     * @param SliderImageRepository $sliderImageRepository
     */
    public function __construct(SliderImageRepository $sliderImageRepository)
    {
        $this->sliderImageRepository = $sliderImageRepository;
        $this->setActionRepository($sliderImageRepository);
    }


    public function itemList($sliderId, $type)
    {
        return $this->sliderImageRepository->getSliderImage($sliderId, $type);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeSliderImage($data, $sliderId)
    {
        $other_attributes = request()->only('monthly_rate', 'google_play_link', 'app_store_link');
        $data['other_attributes'] = json_encode($other_attributes);
        $count = count($this->sliderImageRepository->findAll());
        $imageUrl = $this->imageUpload($data, $data['title'], 'slider-images');
        $data['image_url'] = $imageUrl;
        $data['slider_id'] = $sliderId;
        $data['sequence'] = ++$count;
        $this->save($data);
        return new Response('Slider Image added successfully');
    }

    public function tableSortable($data)
    {
        $this->sliderImageRepository->sliderImageTableSort($data);
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
        $other_attributes = request()->only('monthly_rate', 'google_play_link', 'app_store_link');
        $data['other_attributes'] = json_encode($other_attributes);
        if (!empty($data['image_url'])){
            $imageUrl = $this->imageUpload($data, $data['title'], 'slider-images');
            $data['image_url'] = $imageUrl;
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
