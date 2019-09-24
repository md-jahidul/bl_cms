<?php
namespace App\Services;


use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class SliderService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $sliderRepository;

    /**
     * DigitalServicesService constructor.
     * @param SliderRepository $sliderRepository
     */
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
        $this->setActionRepository($sliderRepository);
    }

    /**
     * Storing the slider resource
     * @return Response
     */
    public function storeSlider($data)
    {
        //Todo:: Make the short code dynamic
        $data['short_code'] = uniqid();
        $this->save($data);
        return new Response('Slider added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateSlider($data, $id)
    {
        $slider = $this->findOne($id);
        $slider->update($data);
        return Response('Slider updated successfully !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteSlider($id)
    {
        $slider = $this->findOne($id);
        $slider->delete();
        return Response('Slider deleted successfully !');
    }

}