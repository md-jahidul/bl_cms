<?php

namespace App\Services;

use App\Models\PopupBanner;
use App\Repositories\PopupBannerRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

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

    /**
     * @return mixed
     */
    public function createBanner($request)
    {
        $path = '';
        if (isset($request->banner_data)) {
            $path = $data['banner'] = 'storage/' . $request->banner_data->store('app_banner_popup'); 
        }
        $data['banner'] = $path;
        $data['deeplink'] = $request->deeplink;
        $data['status'] = $request->status;
        $data['is_priority'] = $request->is_priority;
        $result = $this->popupBannerRepository->save($data);
        //update all data for priority
        $this->popupBannerRepository->priorityUpdate($request);

        return $result;
    }

    /**
     * @return mixed
     */
    public function updateBanner($request,$id)
    {
        if (isset($request->banner_data)) {
            $data['banner'] = 'storage/' . $request->banner_data->store('app_banner_popup');
        }
        $data['deeplink'] = $request->deeplink;
        $data['status'] = $request->status;
        $data['is_priority'] = $request->is_priority;
        $banner = $this->findOne($id);
        $result = $banner->update($data);

        //update all data for priority
        $this->popupBannerRepository->priorityUpdate($request);

        return $result;
    }



    public function tableSort($data)
    {
        $this->popupBannerRepository->manageTableSort($data);
        return new Response('Sorted successfully');
    }

    public function findBanner($id)
    {
        return $this->popupBannerRepository->findOne($id);
    }

    public function deleteBanner($id)
    {
        $banner = $this->popupBannerRepository->findOne($id);
        return $banner->delete();

    }





}
