<?php

namespace App\Services;

use App\Models\PartnerCategory;
use App\Models\PartnerArea;
use App\Models\PartnerOfferDetail;
use App\Repositories\PartnerOfferDetailRepository;
use App\Repositories\PartnerOfferRepository;
use App\Repositories\ProductDetailRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PartnerOfferService
{
    use CrudTrait;
    use FileTrait;

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

    public function getAreaList(){
        $response = PartnerArea::get();
        return $response;
    }

    public function itemList($partnerId, $isHome = false)
    {
        return $this->partnerOfferRepository->getPartnerOffer($partnerId, $isHome);
    }

    public function campaignOffers()
    {
        return $this->partnerOfferRepository->campaign();
    }

    /**
     * @param $data
     * @param $partnerId
     * @return Response
     */
    public function storePartnerOffer($data, $partnerId)
    {
        $count = count($this->partnerOfferRepository->findAll());
        $data['partner_id'] = $partnerId;
        if (request()->hasFile('campaign_img')) {
            $data['campaign_img'] = $this->upload($data['campaign_img'], 'assetlite/images/campaign-image');
        }
        if (request()->hasFile('card_img')) {
            $data['card_img'] = $this->upload($data['card_img'], 'assetlite/images/partner-offer');
        }
        $data['display_order'] = ++$count;
        $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
        $data['phone'] = json_encode($data['phone']);
        $data['location'] = json_encode($data['location']);
        $data['created_by'] = Auth::id();
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
     * @return ResponseFactory|Response
     */
    public function updatePartnerOffer($data, $id)
    {
        $partnerOffer = $this->findOne($id);
        $data['is_campaign'] = (isset($data['is_campaign'])) ? 1 : 0;
        $data['show_in_home'] = (isset($data['show_in_home'])) ? 1 : 0;

        if (!empty($data['campaign_img'])) {
            $data['campaign_img'] = $this->upload($data['campaign_img'], 'assetlite/images/campaign-image/');
            $this->deleteFile($partnerOffer->campaign_img);
        }
        if ($data['is_campaign'] == 0 && !empty($partnerOffer->campaign_img)) {
            $this->deleteFile($partnerOffer->campaign_img);
            $data['campaign_img'] = null;
        }

        if (request()->hasFile('card_img')) {
            $data['card_img'] = $this->upload($data['card_img'], 'assetlite/images/partner-offer');
            $this->deleteFile($partnerOffer->card_img);
        }

        $data['phone'] = json_encode($data['phone']);
        $data['location'] = json_encode($data['location']);


        if (isset($data['silver'])) {
            $data['silver'] == 1;
        } else {
            $data['silver'] = 0;
        }
        if (isset($data['gold'])) {
            $data['gold'] == 1;
        } else {
            $data['gold'] = 0;
        }
        if (isset($data['platium'])) {
            $data['platium'] == 1;
        } else {
            $data['platium'] = 0;
        }

        $data['updated_by'] = Auth::id();
        $partnerOffer->update($data);
        return Response('Partner offer update successfully !');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deletePartnerOffer($id)
    {
        $partnerOffer = $this->findOne($id);
        $this->deleteFile($partnerOffer->campaign_img);
        $partnerOffer->delete();
        return Response('Partner offer delete successfully');
    }
}
