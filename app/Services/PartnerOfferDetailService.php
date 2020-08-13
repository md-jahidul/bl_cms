<?php

namespace App\Services;

use App\Models\PartnerCategory;
use App\Models\PartnerOfferDetail;
use App\Repositories\PartnerOfferDetailRepository;
use App\Repositories\PartnerOfferRepository;
use App\Repositories\ProductDetailRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;

class PartnerOfferDetailService
{
    use CrudTrait;
    use FileTrait;

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
        if (!empty($data['banner_image_url'])) {
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/partner_offer');
        }

        if (!empty($data['banner_mobile_view'])) {
            $data['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], 'assetlite/images/banner/partner_offer');
        }
        $data['updated_by'] = Auth::id();
        $partnerOffer->update($data);
        return Response('Partner offer Details update successfully !');
    }

}
