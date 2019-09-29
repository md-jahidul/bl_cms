<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class MyblSliderService
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
     * Storing the banner resource
     * @return Response
     */
    public function storeSlider($data)
    {
        $data['short_code'] = strtolower(str_replace(' ','_',$data['title'])); 
        $this->save($data);
        return new Response("Slider has been successfully created");
    }

    public function getAppSlider()
    {
        return $this->sliderRepository->getAppSlider();
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSlider($request, $slider)
    {
        $slider->update($request->all());
        return Response('Slider has been successfully updated');
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
        return Response('Slider has been successfully deleted');
    }

}
