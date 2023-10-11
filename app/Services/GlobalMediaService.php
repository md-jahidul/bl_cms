<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Models\Media;
use App\Repositories\GlobalMediaSettingRepository;
use App\Repositories\GlobalSettingRepository;
use App\Repositories\SettingRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DB;
use Illuminate\Support\Facades\Auth;

class GlobalMediaService
{
    use CrudTrait;


    /**
     * @var SettingRepository
     */
    protected $mediaSettingRepository;


    /**
     * SettingService constructor.
     * @param SettingRepository $settingRepository
     */
    public function __construct(GlobalMediaSettingRepository $mediaSettingRepository)
    {
        $this->mediaSettingRepository = $mediaSettingRepository;
        $this->setActionRepository($mediaSettingRepository);
    }

    /**
     * Storing the banner resource
     * @return array
     */
    public function storeMedia($request): array
    {
        $media = $this->mediaSettingRepository->is_exist($request['key_name']);
        if (isset($media)) {
            $media_response['saved'] = false;
            $media_response['response'] = new Response("Setting Already exists");

        } else {
            $data = $request->all();
            $imageLocation = 'storage/' . $data['image']->store('global-media');
            $data['image_location'] = $imageLocation;
            $data['updated_by'] = Auth::id();
            $this->mediaSettingRepository->save($data);
            $media_response['saved'] = true;
            $media_response['response'] = new Response("Setting has been successfully created");
        }
        return $media_response;
    }

    public function getFilteredData($filterKey){
        return   $this->mediaSettingRepository->getFilteredData($filterKey);
    }


}
