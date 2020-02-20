<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 18/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessOthersRepository;
use App\Repositories\BusinessAssignedFeaturesRepository;
use App\Repositories\BusinessComPhotoTextRepository;
use App\Repositories\BusinessComPkOneRepository;
use App\Repositories\BusinessComPkTwoRepository;
use App\Repositories\BusinessComFeaturesRepository;
use App\Repositories\BusinessComPriceTableRepository;
use App\Repositories\BusinessComVideoRepository;
use App\Repositories\BusinessComPhotoRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class BusinessOthersService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $otherRepo
     * @var $asgnFeatureRepo
     */
    protected $otherRepo;
    protected $photoTextRepo;
    protected $pkOneRepo;
    protected $pkTwoRepo;
    protected $featureRepo;
    protected $priceTableRepo;
    protected $videoRepo;
    protected $photoRepo;
    protected $asgnFeatureRepo;

    /**
     * BusinessPackageService constructor.
     * @param BusinessOthersRepository $otherRepo
     * @param BusinessComPhotoTextRepository $photoTextRepo
     * @param BusinessComPkOneRepository $pkOneRepo
     * @param BusinessComPkTwoRepository $pkTwoRepo
     * @param BusinessComFeaturesRepository $featureRepo
     * @param BusinessComPriceTableRepository $priceTableRepo
     * @param BusinessComVideoRepository $videoRepo
     * @param BusinessComPhotoRepository $photoRepo
     * @param BusinessAssignedFeaturesRepository $asgnFeatureRepo
     */
    public function __construct(
    BusinessOthersRepository $otherRepo, BusinessComPhotoTextRepository $photoTextRepo, BusinessComPkOneRepository $pkOneRepo, BusinessComPkTwoRepository $pkTwoRepo, BusinessComFeaturesRepository $featureRepo, BusinessComPriceTableRepository $priceTableRepo, BusinessComVideoRepository $videoRepo, BusinessComPhotoRepository $photoRepo, BusinessAssignedFeaturesRepository $asgnFeatureRepo
    ) {
        $this->otherRepo = $otherRepo;
        $this->photoTextRepo = $photoTextRepo;
        $this->pkOneRepo = $pkOneRepo;
        $this->pkTwoRepo = $pkTwoRepo;
        $this->featureRepo = $featureRepo;
        $this->priceTableRepo = $priceTableRepo;
        $this->videoRepo = $videoRepo;
        $this->photoRepo = $photoRepo;
        $this->asgnFeatureRepo = $asgnFeatureRepo;
        $this->setActionRepository($otherRepo);
    }

    /**
     * get other service list
     * @return Response
     */
    public function getOtherService($type) {
        $servces = $this->otherRepo->getOtherService($type);
        return $servces;
    }

    /**
     * save business other services
     * @return Response
     */
    public function saveService($request) {
        try {

            $request->validate([
                'type' => 'required',
                'name' => 'required',
                'short_details' => 'required',
                'banner_photo' => 'required|mimes:jpg,jpeg,png',
                'icon' => 'required|mimes:jpg,jpeg,png',
            ]);



            //file upload in storege
            $bannerPath = "";
            if ($request['banner_photo'] != "") {
                $bannerPath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');
            }
            $iconPath = "";
            if ($request['icon'] != "") {
                $iconPath = $this->upload($request['icon'], 'assetlite/images/business-images');
            }

            //save data in database 
            $serviceId = $this->otherRepo->saveService($bannerPath, $iconPath, $request);
            $types = array("business-solusion" => 2, "iot" => 3, "others" => 4);
            $parentTypes = $types[$request->type];

            $this->asgnFeatureRepo->assignFeature($serviceId, $parentTypes, $request->feature);



            $response = [
                'success' => 1,
                'message' => "Service Saved",
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
     * save business other components
     * @return Response
     */
    public function saveComponents($request) {
        try {

            $srvsId = $request->service_id;


            //save photo text
            $this->_savePhotoText($request->com_pt_text, $request->com_pt_photo, $srvsId);

            //save package comparison one
            $p1Head = $request->com_pc1_table_head;
            $p1Text = $request->com_pc1_feature_text;
            $p1Price = $request->com_pc1_price;
            $this->_savePackageOne($p1Head, $p1Text, $p1Price, $srvsId);


            //save package comparison two
            $p2Title = $request->com_pk2_title;
            $p2Name = $request->com_pk2_name;
            $p2Data = $request->com_pk2_data;
            $p2Days = $request->com_pk2_days;
            $p2Price = $request->com_pk2_price;
            $this->_savePackageTwo($p2Title, $p2Name, $p2Data, $p2Days, $p2Price, $srvsId);

            //save package features
            $features = $request->com_ft_text;
            $this->_saveServiceFeature($features, $srvsId);

            //save product price table data
            $ptTitle = $request->com_price_title;
            $ptHead = $request->com_price_head;
            $ptColOne = $request->com_price_column_one;
            $ptColTwo = $request->com_price_column_two;
            $ptColThree = $request->com_price_column_three;
            $this->_saveProductPrice($ptTitle, $ptHead, $ptColOne, $ptColTwo, $ptColThree, $srvsId);

            //save video component
            $videoName = $request->com_vid_name;
            $videoTitle = $request->com_vid_title;
            $videoEmbed = $request->com_vid_embed;
            $videoDes = $request->com_vid_description;
            $this->_saveVideoComponent($videoName, $videoTitle, $videoEmbed, $videoDes, $srvsId);


            //save photo component
            $photoOne = $request->com_photo_one;
            $photoTwo = $request->com_photo_two;
            $photoThree = $request->com_photo_three;
            $photoFour = $request->com_photo_four;
            $this->_savePhotoComponent($photoOne, $photoTwo, $photoThree, $photoFour, $srvsId);

            $response = [
                'success' => 1,
                'message' => "Service Saved",
            ];


            return $response;
        } catch (\Exception $e) {
            echo $e->getMessage();
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    //save photo text component
    private function _savePhotoText($text, $photo, $serviceId) {
        if (!empty($text)) {
            foreach ($text as $position => $t) {
                $photoVal = $photo[$position];
                $bannerPath = $this->upload($photoVal, 'assetlite/images/business-images');
                $this->photoTextRepo->saveComponent($position, $t, $bannerPath, $serviceId);
            }
        }
    }

    //save package comparison one
    private function _savePackageOne($p1Head, $p1Text, $p1Price, $srvsId) {
        if (!empty($p1Head)) {
            foreach ($p1Head as $position => $head) {
                $ftText = $p1Text[$position];
                $price = $p1Price[$position];
                $this->pkOneRepo->saveComponent($position, $head, $ftText, $price, $srvsId);
            }
        }
    }

    //save package comparison two
    private function _savePackageTwo($p2Title, $p2Name, $p2Data, $p2Days, $p2Price, $srvsId) {
        if (!empty($p2Title)) {
            foreach ($p2Title as $position => $title) {
                $name = $p2Name[$position];
                $data = $p2Data[$position];
                $days = $p2Days[$position];
                $price = $p2Price[$position];
                $this->pkTwoRepo->saveComponent($position, $title, $name, $data, $days, $price, $srvsId);
            }
        }
    }

    //save service features
    private function _saveServiceFeature($features, $srvsId) {
        if (!empty($features)) {
            foreach ($features as $position => $ft) {
                $this->featureRepo->saveComponent($position, $ft, $srvsId);
            }
        }
    }

    //save product price table
    private function _saveProductPrice($ptTitle, $ptHead, $ptColOne, $ptColTwo, $ptColThree, $srvsId) {
        if (!empty($ptTitle)) {
            foreach ($ptTitle as $position => $title) {
                $head = $ptHead[$position];
                $colOne = $ptColOne[$position];
                $colTwo = $ptColTwo[$position];
                $colThree = $ptColThree[$position];
                $this->priceTableRepo->saveComponent($position, $title, $head, $colOne, $colTwo, $colThree, $srvsId);
            }
        }
    }

    //save video component
    private function _saveVideoComponent($videoName, $videoTitle, $videoEmbed, $videoDes, $srvsId) {
        if (!empty($videoName)) {
            foreach ($videoName as $position => $name) {
                $title = $videoTitle[$position];
                $embed = $videoEmbed[$position];
                $description = $videoDes[$position];
                $this->videoRepo->saveComponent($position, $name, $title, $embed, $description, $srvsId);
            }
        }
    }

    //save video component
    private function _savePhotoComponent($photoOne, $photoTwo, $photoThree, $photoFour, $srvsId) {
        if (!empty($photoOne)) {
            foreach ($photoOne as $position => $pOne) {
                $pTwo = $photoTwo[$position];
                $pThree = $photoThree[$position];
                $pFour = $photoFour[$position];

                $onePath = $this->upload($pOne, 'assetlite/images/business-images');
                $twoPath = $this->upload($pTwo, 'assetlite/images/business-images');
                $threePath = $this->upload($pThree, 'assetlite/images/business-images');
                $fourPath = $this->upload($pFour, 'assetlite/images/business-images');

                $this->photoRepo->saveComponent($position, $onePath, $twoPath, $threePath, $fourPath, $srvsId);
            }
        }
    }

    /**
     * Change service home show status
     * @return Response
     */
    public function homeStatusChange($serviceId) {
        $response = $this->otherRepo->changeHomeShowStatus($serviceId);
        return $response;
    }

    /**
     * Change service active/inactive
     * @return Response
     */
    public function packageActive($serviceId) {
        $response = $this->otherRepo->changeStatus($serviceId);
        return $response;
    }

     /**
     * Change package sorting
     * @return Response
     */
    public function changeServiceSort($request) {
        $response = $this->otherRepo->changeServiceSorting($request);
        return $response;
    }

    /**
     * Get business package by id
     * @return Response
     */
    public function getServiceById($serviceId) {
        $response = $this->otherRepo->getServiceById($serviceId);
        return $response;
    }

    /**
     * Get business package by id
     * @return Response
     */
    public function getFeaturesByService($serviceType, $serviceId) {
        $types = array("business-solusion" => 2, "iot" => 3, "others" => 4);
        $parentType = $types[$serviceType];
        $response = $this->asgnFeatureRepo->getAssignedFeatures($serviceId, $parentType);
        return $response;
    }

    /**
     * update business landing page news
     * @return Response
     */
    public function updateService($request) {
        try {

              $request->validate([
                'type' => 'required',
                'name' => 'required',
                'short_details' => 'required',
            ]);

            //banner file replace in storege
            $bannerPath = "";
            if ($request['banner_photo'] != "") {
                $filePath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');

                //delete old photo
                if ($request['old_banner']) {
                    $this->deleteFile($request['old_banner']);
                }
            }
            
            //icon file replace in storege
            $iconPath = "";
            if ($request['icon'] != "") {
                $iconPath = $this->upload($request['icon'], 'assetlite/images/business-images');

                //delete old photo
                if ($request['old_icon']) {
                    $this->deleteFile($request['old_icon']);
                }
            }

            //save data in database 
            $this->otherRepo->updateService($bannerPath, $iconPath, $request);
            
             $types = array("business-solusion" => 2, "iot" => 3, "others" => 4);
            $parentTypes = $types[$request->type];
            $this->asgnFeatureRepo->assignFeature($request->service_id, $parentTypes, $request->feature);

            $response = [
                'success' => 1,
                'message' => "Package updated"
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
     * delete business package
     * @return Response
     */
    public function deleteService($serviceId) {

        try {

            $service = $this->findOne($serviceId);
            $this->deleteFile($service->banner_photo);
            $this->deleteFile($service->icon);
            $service->delete();

            $response = [
                'success' => 1,
                'message' => "Package deleted"
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

}
