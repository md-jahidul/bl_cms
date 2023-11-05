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



 // to external data storage
//    public function storeMedia($request): array
//    {
//        $media = $this->mediaSettingRepository->is_exist($request['key_name']);
//
//        if (isset($media)) {
//            $media_response['saved'] = false;
//            $media_response['response'] = new Response("Setting Already exists");
//        } else {
//            $data = $request->all();
//            $defaultStorageLocation = config('filesystems.media_storage_location'); // Get the default storage location from config
//
//            // Check if the default storage location is valid and writable
////            dd($defaultStorageLocation, is_writable($defaultStorageLocation));
//
////            if (!is_writable($defaultStorageLocation)) {
////                $media_response['saved'] = false;
////                $media_response['response'] = new Response("Error: Default storage location is not writable or does not exist.");
////                return $media_response;
////            }
//
//            // Upload the file to the default storage server location
//            $uploadedFile = $data['image'];
//            $filename = $uploadedFile->getClientOriginalName();
//            $fileLocation = $defaultStorageLocation . '/' . $filename;
//
//            // Check if the file was successfully uploaded
//            if (!$uploadedFile->storeAs($defaultStorageLocation, $filename)) {
//                $media_response['saved'] = false;
//                $media_response['response'] = new Response("Error: File upload failed.");
//                return $media_response;
//            }
//
//
//            // Save the file location in the database
//            $data['image_location'] = $fileLocation;
//            $data['updated_by'] = Auth::id();
//            $this->mediaSettingRepository->save($data);
//
//            $media_response['saved'] = true;
//            $media_response['response'] = new Response("Setting has been successfully created");
//        }
//        return $media_response;
//    }


    public function getFilteredData($filterKey)
    {
        return $this->mediaSettingRepository->getFilteredData($filterKey);
    }


}
