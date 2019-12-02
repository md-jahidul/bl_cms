<?php

namespace App\Services;

use App\Models\PartnerCategory;
use App\Models\PartnerOfferDetail;
use App\Repositories\PartnerOfferDetailRepository;
use App\Repositories\PartnerOfferRepository;
use App\Repositories\ProductDetailRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class PartnerOfferService
{
    use CrudTrait;

    /**
     * @var $partnerOfferRepository
     */
    protected $partnerOfferRepository;
    protected $partnerOfferDetailRepository;

    /**
     * PartnerOfferService constructor.
     * @param PartnerOfferRepository $partnerOfferRepository
     * @param PartnerOfferDetailRepository $partnerOfferDetailRepository
     */
    public function __construct(
        PartnerOfferRepository $partnerOfferRepository,
        PartnerOfferDetailRepository $partnerOfferDetailRepository
    ) {
        $this->partnerOfferRepository = $partnerOfferRepository;
        $this->partnerOfferDetailRepository = $partnerOfferDetailRepository;
        $this->setActionRepository($partnerOfferRepository);
    }


    public function itemList($partnerId, $isHome = false)
    {
        return $this->partnerOfferRepository->getPartnerOffer($partnerId, $isHome);
    }

    public function campaignOffers()
    {
        return $this->partnerOfferRepository->campaigin();
    }

    /**
     * @param $data
     * @return Response
     */
    public function storePartnerOffer($data, $partnerId)
    {

        $count = count($this->partnerOfferRepository->findAll());
        $data['partner_id'] = $partnerId;
        if (!empty($data['campaign_img'])) {
            $imageUrl = $this->imageUpload($data, 'campaign_img', $data['offer_en'], 'images/campaign-image/');
            $data['campaign_img'] = "/images/campaign-image/" . $imageUrl;
        }
        $data['display_order'] = ++$count;
        $offerId = $this->save($data);


        $this->partnerOfferDetailRepository->insertOfferDetail($offerId->id);
        return new Response('Partner offer added successfully');
    }

    public function partnerOfferSortable($data)
    {
        $this->partnerOfferRepository->sortable($data);
        return new Response('update successfully');
    }

    public function campaignOfferSortable($data)
    {
        $this->partnerOfferRepository->sortable($data, 'campaign_order');
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
        $data['is_campaign'] = (isset($data['is_campaign'])) ? 1 : 0;

        $data['show_in_home'] = (isset($data['show_in_home'])) ? 1 : 0;

        if (!empty($data['campaign_img'])) {
            $imageUrl = $this->imageUpload($data, 'campaign_img', $data['validity_en'], 'images/campaign-image/');
            $data['campaign_img'] = "images/campaign-image/" . $imageUrl;
//            ($partnerOffer->campaign_img != '') ? unlink(public_path($partnerOffer->campaign_img)) : '';
        }
        if ($data['is_campaign'] == 0 && !empty($partnerOffer->campaign_img)) {
//            unlink(public_path('images/campaign-image/' . $partnerOffer->campaign_img));
            $data['campaign_img'] = null;
        }


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
