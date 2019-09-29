<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\InternetOfferRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class InternetOfferService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $internetOfferRepository;

    /**
     * DigitalServicesService constructor.
     * @param SliderRepository $sliderRepository
     */
    public function __construct(InternetOfferRepository $internetOfferRepository)
    {
        $this->internetOfferRepository = $internetOfferRepository;
        $this->setActionRepository($internetOfferRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeInternetOffer($data)
    {
        $this->save($data);
        return new Response("Internet offer has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateInternetOffer($request, $id)
    {
        $data = $this->findOne($id);
        $data->update($request->all());
        return Response('Internet Offer has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroyInternetOffer($id)
    {
        $data = $this->findOne($id);
        $data->delete();
        return Response('Internet Offer has been successfully deleted');
    }

}
