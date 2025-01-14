<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AmarOfferRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class AmarOfferService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $amarOfferRepository;

    /**
     * AmarOfferService constructor.
     * @param AmarOfferRepository $amarOfferRepository
     */
    public function __construct(AmarOfferRepository $amarOfferRepository)
    {
        $this->amarOfferRepository = $amarOfferRepository;
        $this->setActionRepository($amarOfferRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeAmarOffer($data)
    {
        $this->save($data);
        return new Response("Amar Offer has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateAmarOffer($request, $id)
    {
        $nearByOffer = $this->findOne($id);
        $nearByOffer->update($request);
        return Response('Amar Offer has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteAmarOffer($id)
    {
        $data = $this->findOne($id);
        $data->delete();
        return Response('Amar Offer has been successfully deleted');
    }
}
