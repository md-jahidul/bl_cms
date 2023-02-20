<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Services;

use App\Repositories\RoamingOfferRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class RoamingOfferService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $catRepo
     */
    protected $offerRepo;

    /**
     * RoamingGeneralService constructor.
     * @param RoamingOfferRepository $offerRepo
     */
    public function __construct(
    RoamingOfferRepository $offerRepo
    ) {
        $this->offerRepo = $offerRepo;
    }

    /**
     * Get Roaming offer categories
     * @return Response
     */
    public function getCategories() {
        $response = $this->offerRepo->getCategoryList();
        return $response;
    }

    /**
     * Get single category data by Id
     * @return Response
     */
    public function getCategoryById($catId) {
        $response = $this->offerRepo->getCategory($catId);
        return $response;
    }

    /**
     * update roaming category
     * @return Response
     */
    public function updateCategory($request) {
        try {

            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
            ]);
            //save data in database
            $this->offerRepo->updateCategory($request);

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
     * Change category sorting
     * @return Response
     */
    public function changeCategorySort($request) {
        $response = $this->offerRepo->changeCategorySorting($request);
        return $response;
    }

    /**
     * Get Roaming offers
     * @return Response
     */
    public function getOffers() {
        $response = $this->offerRepo->getOffers();
        return $response;
    }

    /**
     * Get Roaming offers
     * @return Response
     */
    public function getOfferById($offerId) {
        $response = $this->offerRepo->getOfferById($offerId);
        return $response;
    }

    /**
     * update roaming category
     * @return Response
     */
    public function saveOffer($request) {
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


            $cardImagePath = "";
            if ($request['card_image'] != "") {
                $cardImagePath = $this->upload($request['card_image'], 'assetlite/images/roaming');
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
            $this->offerRepo->saveOffer($seoNameWeb, $seoNameMob, $cardImagePath, $request);


            return [
                'success' => 1,
            ];
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
     * @return int[]
     */
    public function updateOffer($request) {
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

            $cardImagePath = "";
            if ($request['card_image'] != "") {
                $cardImagePath = $this->upload($request['card_image'], 'assetlite/images/roaming');
            }

            //save data in database
            $this->offerRepo->saveOffer($seoNameWeb, $seoNameMob, $cardImagePath, $request);

            return [
                'success' => 1,
            ];
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
    public function deleteOffer($offerId) {
        try {

            $offer = $this->offerRepo->getOfferById($offerId);

            //delete old mobile photo
            if ($offer->banner_web != "") {
                $this->deleteFile($offer->banner_web);
            }
            if ($offer->banner_mobile != "") {
                $this->deleteFile($offer->banner_mobile);
            }

            //delete data
            $this->offerRepo->deleteOffer($offerId);



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
     * Get Roaming offers
     * @return Response
     */
    public function getOfferComponents($offerId) {
        $response = $this->offerRepo->getOfferComponents($offerId);
        return $response;
    }


     /**
     * update roaming category
     * @return Response
     */
    public function updateComponents($request) {
        try {


            //save data in database
        $this->offerRepo->saveComponents($request);

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
        $response = $this->offerRepo->changeComponentSorting($request);
        return $response;
    }

         /**
     * delete component
     * @return Response
     */
    public function componentDelete($comId) {
        $response = $this->offerRepo->componentDelete($comId);
        return $response;
    }

}
