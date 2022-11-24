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
        }
        return $this->popupBannerRepository->save($data);
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
            $data['deeplink'] = $request->deeplink;
            $data['status'] = $request->status;
        }
        $banner = $this->findOne($id);
        return $banner->update($data);

        //return $this->popupBannerRepository->update($data);
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
