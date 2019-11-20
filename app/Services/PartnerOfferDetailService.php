<?php

namespace App\Services;

use App\Models\PartnerCategory;
use App\Models\PartnerOfferDetail;
use App\Repositories\PartnerOfferDetailRepository;
use App\Repositories\PartnerOfferRepository;
use App\Repositories\ProductDetailRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class PartnerOfferDetailService
{
    use CrudTrait;

    /**
     * @var $partnerOfferDetailRepository
     */
    protected $partnerOfferDetailRepository;

    /**
     * PartnerOfferDetailService constructor.
     * @param PartnerOfferDetailRepository $partnerOfferDetailRepository
     */
    public function __construct(PartnerOfferDetailRepository $partnerOfferDetailRepository)
    {
        $this->partnerOfferDetailRepository = $partnerOfferDetailRepository;
        $this->setActionRepository($partnerOfferDetailRepository);
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updatePartnerOfferDetails($data, $id)
    {
        $partnerOffer = $this->findOne($id);
        $partnerOffer->update($data);
        return Response('Partner offer Details update successfully !');
    }

}
