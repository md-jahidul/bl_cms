<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\SliderTypeRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class SliderTypeService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $sliderTypeRepository;

    /**
     * DigitalServicesService constructor.
     * @param SliderTypeRepository $sliderTypeRepository
     */
    public function __construct(SliderTypeRepository $sliderTypeRepository)
    {
        $this->sliderTypeRepository = $sliderTypeRepository;
        $this->setActionRepository($sliderTypeRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeSlider($data)
    {
       
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSlider($data, $banner)
    {

        
        
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteSlider($id)
    {
        
    }

}
