<?php

namespace App\Services;

use App\Models\PopupBanner;
use App\Repositories\PopupBannerRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class PopupBannerService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $PopupBannerRepository
     */
    protected $popupBannerRepository;

    /**
     * PartnerService constructor.
     * @param popupBannerRepository $partnerRepository
     */

    public function __construct(PopupBannerRepository $popupBannerRepository)
    {
        $this->popupBannerRepository = $popupBannerRepository;
        $this->setActionRepository($popupBannerRepository);
    }

    /**
     * @return mixed
     */
    public function getPopupBanner()
    {

        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        return $this->popupBannerRepository->findAll(null, null,  $orderBy);
    }

    public function tableSort($data)
    {
        $this->popupBannerRepository->manageTableSort($data);
        return new Response('Sorted successfully');
    }

}
