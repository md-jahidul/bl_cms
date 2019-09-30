<?php
namespace App\Services;

use App\Models\PartnerCategory;
use App\Repositories\PartnerOfferRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class PartnerOfferService
{
    use CrudTrait;
    /**
     * @var $partnerOfferRepository
     */
    protected $partnerOfferRepository;

    /**
     * PartnerOfferService constructor.
     * @param PartnerOfferRepository $partnerOfferRepository
     */
    public function __construct(PartnerOfferRepository $partnerOfferRepository)
    {
        $this->partnerOfferRepository = $partnerOfferRepository;
        $this->setActionRepository($partnerOfferRepository);
    }


    public function itemList($partnerId)
    {
        return $this->partnerOfferRepository->getPartnerOffer($partnerId);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storePartnerOffer($data, $partnerId)
    {

        $count = count($this->partnerOfferRepository->findAll());
        $data['partner_id'] = $partnerId;
        $data['display_order'] = ++$count;
        $this->save($data);
        return new Response('Partner offer added successfully');
    }

    public function tableSortable($data)
    {
        $this->partnerOfferRepository->partnerOfferTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updatePartnerOffer($data, $id)
    {

        $partnerOffer = $this->findOne($id);
        (isset($data['show_in_home'])) ? $data['show_in_home'] = 1 : $data['show_in_home'] = 0;
        $partnerOffer->update($data);
        return Response('Partner offer update successfully !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deletePartnerOffer($id)
    {
        $partnerOffer = $this->findOne($id);
        $partnerOffer->delete();
        return Response('Partner offer delete successfully');
    }

}
