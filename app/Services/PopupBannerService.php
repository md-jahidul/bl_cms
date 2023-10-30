<?php

namespace App\Services;

use App\Helpers\Helper;
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
        $data = $request->all();
        $path = '';
        if (isset($request->banner_data)) {
            $path = $data['banner'] = 'storage/' . $request->banner_data->store('app_banner_popup');
        }
        $data['banner'] = $path;
        $data['deeplink'] = $request->deeplink;
        $data['status'] = $request->status;
        $data['is_priority'] = $request->is_priority;
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);

        $result = $this->popupBannerRepository->save($data);
        //update all data for priority
        $this->popupBannerRepository->priorityUpdate($request);
        Redis::del('popup-banner');
        return $result;
    }

    /**
     * @return mixed
     */
    public function updateBanner($request, $id)
    {
        $data = $request->all();

        if (isset($request->banner_data)) {
            $data['banner'] = 'storage/' . $request->banner_data->store('app_banner_popup');
        }
        $data['deeplink'] = $request->deeplink;
        $data['status'] = $request->status;
        $data['is_priority'] = $request->is_priority;
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);

        $banner = $this->findOne($id);
        $result = $banner->update($data);

        //update all data for priority
        $this->popupBannerRepository->priorityUpdate($request);
        Redis::del('popup-banner');

        return $result;
    }



    public function tableSort($data)
    {
        $this->popupBannerRepository->manageTableSort($data);
        Redis::del('popup-banner');

        return new Response('Sorted successfully');
    }

    public function findBanner($id)
    {
        $component = $this->popupBannerRepository->findOne($id);
        $android_version_code = implode('-',
            [$component['android_version_code_min'], $component['android_version_code_max']]);
        $ios_version_code = implode('-', [$component['ios_version_code_min'], $component['ios_version_code_max']]);
        $component->android_version_code = $android_version_code;
        $component->ios_version_code = $ios_version_code;

        return $component;
    }

    public function deleteBanner($id)
    {
        $banner = $this->popupBannerRepository->findOne($id);
        Redis::del('popup-banner');

        return $banner->delete();

    }





}
