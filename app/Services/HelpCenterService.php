<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\HelpCenterRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class HelpCenterService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $helpCenterRepository;

    /**
     * DigitalServicesService constructor.
     * @param helpCenterRepository $helpCenterRepository
     */
    public function __construct(HelpCenterRepository $helpCenterRepository)
    {
        $this->helpCenterRepository = $helpCenterRepository;
        $this->setActionRepository($helpCenterRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeSlider($data)
    {
        $data['short_code'] = strtolower(str_replace(' ','_',$data['title'])); 
        $this->save($data);
        return new Response("Slider has successfully been created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSlider($request, $slider)
    {
        $slider->update($request->all());
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
