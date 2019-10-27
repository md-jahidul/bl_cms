<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\MixedBundleOfferRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;


class MixedBundleOfferService
{

    use CrudTrait;
    /**
     * @var $mixedBundleOfferRepository
     */
    protected $mixedBundleOfferRepository;

    /**
     * DigitalServicesService constructor.
     * @param MixedBundleOfferRepository $mixedBundleOfferRepository
     */
    public function __construct(MixedBundleOfferRepository $mixedBundleOfferRepository)
    {
        $this->mixedBundleOfferRepository = $mixedBundleOfferRepository;
        $this->setActionRepository($mixedBundleOfferRepository);
    }

    /**
     * Storing the banner resource
     * @param $data
     * @return Response
     */
    public function storeMixedBundleOffer($data)
    {
        $this->save($data);
        return new Response("Mixed Bundle offer has been successfully created");
    }

    /**
     * Updating the banner
     * @param $request
     * @param $id
     * @return Response
     */
    public function updateMixedBundleOffer($request, $id)
    {
        $data = $this->findOne($id);
        $data->update($request->all());
        return Response('Mixed Bundle Offer has been successfully updated');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteMixedBundleOffer($id)
    {
        $data = $this->findOne($id);
        $data->delete();
        return Response('Mixed Bundle has been successfully deleted');
    }

}
