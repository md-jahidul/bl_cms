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
        if (isset($request->banner_data)) {
            // upload the Banner image
            $file = $request->banner_data;
            $path = $file->storeAs(
                'app-banner-popup',
                strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                'public'
            );
            $data['banner'] = $path;
            $data['deeplink'] = $request->deeplink;
            $data['status'] = $request->status;
            $data['is_priority'] = $request->is_priority;

            //update all data for priority
            $this->popupBannerRepository->priorityUpdate($request);

        }
        $result = $this->popupBannerRepository->save($data);
        // Set Radis Data
        // if($request->banner_data == 1){
        //     $result_data = $result->getOriginal();
        //     $redis_key = 'popup_banner_'.$result_data['id'];
        //     $ttl = 3000;
        //     Redis::setex($redis_key, $ttl, json_encode($result_data));
        // }
        return $result;
    }

    /**
     * @return mixed
     */
    public function updateBanner($request,$id)
    {
        if (isset($request->banner_data)) {
            // upload the Banner image
            $file = $request->banner_data;
            $path = $file->storeAs(
                'app-banner-popup',
                strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                'public'
            );
            $data['banner'] = $path;
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
