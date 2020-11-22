<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Services;

use App\Repositories\RoamingInfoRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class RoamingInfoService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $infoRepo
     */
    protected $infoRepo;

    /**
     * RoamingInfoService constructor.
     * @param RoamingInfoRepository $infoRepo
     */
    public function __construct(
    RoamingInfoRepository $infoRepo
    ) {
        $this->infoRepo = $infoRepo;
    }


    /**
     * Get Roaming offers
     * @return Response
     */
    public function getInfoList() {
        $response = $this->infoRepo->getInfo();
        return $response;
    }


    /**
     * Get Roaming info
     * @return Response
     */
    public function getInfoById($infoId) {
        $response = $this->infoRepo->getInfoById($infoId);
        return $response;
    }

    /**
     * update roaming category
     * @return Response
     */
    public function saveInfo($request) 
    {
        try {
            //file upload in storege
            $webPath = "";
            if ($request['banner_web'] != "") {

                $webPath = $this->upload($request['banner_web'], 'assetlite/images/roaming');
            }

            $mobilePath = "";
            if ($request['banner_mobile'] != "") {

                $mobilePath = $this->upload($request['banner_mobile'], 'assetlite/images/roaming');
            }

            //web rename
            $seoNameWeb = "";
            if ($webPath != "") {
                $webImgArray = explode('/', $webPath);
                $webName = end($webImgArray);
                $webMimeArray = explode('.', $webName);
                $webMime = end($webMimeArray);

                $seoNameWeb = "/assetlite/images/roaming/" . $request->banner_name . "-web." . $webMime;
                $encodeImgWeb = env('UPLOAD_BASE_PATH') . "/" . $webPath;

                $seoImgWeb = env('UPLOAD_BASE_PATH') . $seoNameWeb;
                rename($encodeImgWeb, $seoImgWeb);
            }
            //mobile rename
            $seoNameMob = "";
            if ($mobilePath != "") {
                $mobImgArray = explode('/', $mobilePath);
                $mobName = end($mobImgArray);
                $mobMimeArray = explode('.', $mobName);
                $mobMime = end($mobMimeArray);

                $seoNameMob = "/assetlite/images/roaming/" . $request->banner_name . "-mobile." . $mobMime;
                $encodeImgWeb = env('UPLOAD_BASE_PATH') . "/" . $mobilePath;

                $seoImgMob = env('UPLOAD_BASE_PATH') . $seoNameMob;
                rename($encodeImgWeb, $seoImgMob);
            }

            //save data in database
            $this->infoRepo->saveInfo($seoNameWeb, $seoNameMob, $request);



            $response = [
                'success' => 1,
            ];


            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    /**
     * update info
     * @return Response
     */
    public function updateInfo($request) 
    {
        try {
            //file upload in storege
            $seoNameWeb = $request['old_web'];
            if ($request['banner_web'] != "") {

                //delete old web photo
                if ($request['old_web']) {
                    $this->deleteFile($request['old_web']);
                }

                $webPath = $this->upload($request['banner_web'], 'assetlite/images/roaming');

                $webImgArray = explode('/', $webPath);
                $webName = end($webImgArray);
                $webMimeArray = explode('.', $webName);
                $webMime = end($webMimeArray);

                //rename
                $seoNameWeb = "/assetlite/images/roaming/" . $request->banner_name . "-web." . $webMime;
                $encodeImgWeb = env('UPLOAD_BASE_PATH') . "/" . $webPath;

                $seoImgWeb = env('UPLOAD_BASE_PATH') . $seoNameWeb;
                rename($encodeImgWeb, $seoImgWeb);
            }

            $seoNameMob = $request['old_mobile'];
            if ($request['banner_mobile'] != "") {

                //delete old mobile photo
                if ($request['old_mobile']) {
                    $this->deleteFile($request['old_mobile']);
                }

                $mobilePath = $this->upload($request['banner_mobile'], 'assetlite/images/roaming');

                $mobImgArray = explode('/', $mobilePath);
                $mobName = end($mobImgArray);
                $mobMimeArray = explode('.', $mobName);
                $mobMime = end($mobMimeArray);

                //rename
                $seoNameMob = "/assetlite/images/roaming/" . $request->banner_name . "-mobile." . $mobMime;
                $encodeImgWeb = env('UPLOAD_BASE_PATH') . "/" . $mobilePath;

                $seoImgMob = env('UPLOAD_BASE_PATH') . $seoNameMob;
                rename($encodeImgWeb, $seoImgMob);
            }

            //only rename photo

            if ($request->banner_name_old != $request->banner_name) {

                //web rename
                if ($request['banner_web'] == "") {
                    $webImgArray = explode('/', $request['old_web']);
                    $webName = end($webImgArray);
                    $webMimeArray = explode('.', $webName);
                    $webMime = end($webMimeArray);

                    $seoNameWeb = "/assetlite/images/roaming/" . $request->banner_name . "-web." . $webMime;
                    $encodeImgWeb = env('UPLOAD_BASE_PATH') . $request['old_web'];

                    $seoImgWeb = env('UPLOAD_BASE_PATH') . $seoNameWeb;
                    rename($encodeImgWeb, $seoImgWeb);
                }

                //mobile rename
                if ($request['banner_mobile'] == "") {
                    $mobImgArray = explode('/', $request['old_mobile']);
                    $mobName = end($mobImgArray);
                    $mobMimeArray = explode('.', $mobName);
                    $mobMime = end($mobMimeArray);

                    //rename
                    $seoNameMob = "/assetlite/images/roaming/" . $request->banner_name . "-mobile." . $mobMime;
                    $encodeImgWeb = env('UPLOAD_BASE_PATH') . $request['old_mobile'];

                    $seoImgMob = env('UPLOAD_BASE_PATH') . $seoNameMob;
                    rename($encodeImgWeb, $seoImgMob);
                }
            }

            //save data in database
            $this->infoRepo->saveInfo($seoNameWeb, $seoNameMob, $request);



            $response = [
                'success' => 1,
            ];


            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e
            ];
            return $response;
        }
    }

    /**
     * update roaming category
     * @return Response
     */
    public function deleteInfo($infoId) {
        try {

            $info = $this->infoRepo->getInfoById($infoId);

            //delete old mobile photo
            if ($info->banner_web != "") {
                $this->deleteFile($info->banner_web);
            }
            if ($info->banner_mobile != "") {
                $this->deleteFile($info->banner_mobile);
            }

            //delete data
            $this->infoRepo->deleteInfo($infoId);



            $response = [
                'success' => 1,
            ];


            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    /**
     * Get Roaming offers
     * @return Response
     */
    public function getInfoComponents($infoId) {
        $response = $this->infoRepo->getInfoComponents($infoId);
        return $response;
    }

       /**
     * update components
     * @return Response
     */
    public function updateComponents($request) {
        try {


            //save data in database
            $this->infoRepo->saveComponents($request);

            $response = [
                'success' => 1,
            ];


            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

     /**
     * Change component sorting
     * @return Response
     */
    public function changeComponentSort($request) {
        $response = $this->infoRepo->changeComponentSorting($request);
        return $response;
    }

     /**
     * delete component
     * @return Response
     */
    public function componentDelete($comId) {
        $response = $this->infoRepo->componentDelete($comId);
        return $response;
    }

    /* ###################################### DONE  ################################################# */





}
