<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\MinuteOfferRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class MinuteOfferService
{
    use CrudTrait;

    /**
     * @var $minuteOfferRepository
     */
    protected $minuteOfferRepository;

    /**
     * DigitalServicesService constructor.
     * @param MinuteOfferRepository $minuteOfferRepository
     */
    public function __construct(MinuteOfferRepository $minuteOfferRepository)
    {
        $this->minuteOfferRepository = $minuteOfferRepository;
        $this->setActionRepository($minuteOfferRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeMinuteOffer($data)
    {
        $this->save($data);
        return new Response("Minute offer has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateMinuteOffer($request, $id)
    {
        $data = $this->findOne($id);
        $data->update($request->all());
        return Response('Minute Offer has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteMinuteOffer($id)
    {
        $data = $this->findOne($id);
        $data->delete();
        return Response('Minute Offer has been successfully deleted');
    }
}
