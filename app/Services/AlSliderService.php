<?php

namespace App\Services;

use App\Repositories\AlSliderRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class AlSliderService
{
    use CrudTrait;

    /**
     * @var $alSliderRepository
     */
    protected $alSliderRepository;

    /**
     * AlSliderService constructor.
     * @param AlSliderRepository $alSliderRepository
     */
    public function __construct(AlSliderRepository $alSliderRepository)
    {
        $this->alSliderRepository = $alSliderRepository;
        $this->setActionRepository($alSliderRepository);
    }

    /**
     * @param $type
     * @return AlSliderRepository|Collection|null
     */
    public function sliders($type)
    {
        return $this->alSliderRepository->findByProperties(['slider_type' => $type]);
    }

    public function shortCodeSliders($shortCode)
    {
        return $this->alSliderRepository->findByProperties(['short_code' => $shortCode]);
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
