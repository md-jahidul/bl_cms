<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\NearbyOfferRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class NearbyOfferService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $nearbyOfferRepository;

    /**
     * DigitalServicesService constructor.
     * @param NearbyOfferRepository $sliderRepository
     */
    public function __construct(NearbyOfferRepository $nearbyOfferRepository)
    {
        $this->nearbyOfferRepository = $nearbyOfferRepository;
        $this->setActionRepository($nearbyOfferRepository);
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
