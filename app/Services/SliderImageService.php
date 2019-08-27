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

    /**
     * @param $data
     * @return Response
     */
    public function storeSliderImage($data)
    {
        return new Response('Slider Image added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateSliderImage($data, $id)
    {
        return Response('Slider Image update successfully !');
    }

    public function deleteSliderImage()
    {
        return Response('Slider Image delete successfully');
    }


}