<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\SmsOfferRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class SmsOfferService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $smsOfferRepository;

    /**
     * DigitalServicesService constructor.
     * @param SmsOfferRepository $SmsOfferRepository
     */
    public function __construct(SmsOfferRepository $smsOfferRepository)
    {
        $this->smsOfferRepository = $smsOfferRepository;
        $this->setActionRepository($smsOfferRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeSmsOffer($data)
    {
        $this->save($data);
        return new Response("SMS Offer has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSmsOffer($request, $id)
    {
        $data = $this->findOne($id);
        $data->update($request->all());
        return Response('SMS Offer has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteSmsOffer($id)
    {
        //return $id;
        $data = $this->findOne($id);
        $data->delete();
        return Response('SMS Offer has been successfully deleted');
    }
}
