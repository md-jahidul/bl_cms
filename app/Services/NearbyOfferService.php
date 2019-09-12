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
    public function storeNearbyOffer($data)
    {
        //dd($data);
        // $data['short_code'] = strtolower(str_replace(' ','_',$data['title']));           
        $data['image'] = 'storage/'.$data['image']->store('NearbyOffer_image');
        $this->save($data);
        return new Response("Near By Offer has successfully been created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateNearbyOffer($request, $slider)
    {
        $slider->update($request->all());
        return Response('Slider updated successfully !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteNearbyOffer($id)
    {
        $data = $this->findOne($id);

        unlink($data->image);
        $data->delete();
        return Response('Offer deleted successfully !');
    }

}
