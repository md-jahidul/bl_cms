<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 18/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessOthersRepository;
use App\Repositories\BusinessAssignedFeaturesRepository;
use App\Repositories\BusinessRelatedProductRepository;
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
    protected $relatedProductRepo;

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
     * @param BusinessRelatedProductRepository $relatedProductRepo
     */
    public function __construct(
    BusinessOthersRepository $otherRepo, BusinessComPhotoTextRepository $photoTextRepo, BusinessComPkOneRepository $pkOneRepo, BusinessComPkTwoRepository $pkTwoRepo, BusinessComFeaturesRepository $featureRepo, BusinessComPriceTableRepository $priceTableRepo, BusinessComVideoRepository $videoRepo, BusinessComPhotoRepository $photoRepo, BusinessAssignedFeaturesRepository $asgnFeatureRepo, BusinessRelatedProductRepository $relatedProductRepo
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
        $this->relatedProductRepo = $relatedProductRepo;
        $this->setActionRepository($otherRepo);
    }

    /**
     * get other service list
     * @return Response
     */
    public function getOtherService($type = "", $serviceId = 0) {
        $servces = $this->otherRepo->getOtherService($type, $serviceId);
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
                'name_en' => 'required',
                'name_bn' => 'required',
                'short_details_en' => 'required',
                'short_details_bn' => 'required',
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
            $types = array("business-solution" => 2, "iot" => 3, "others" => 4);
            $parentTypes = $types[$request->type];

            $this->asgnFeatureRepo->assignFeature($serviceId, $parentTypes, $request->feature);

            $parentType = 2;
            $this->relatedProductRepo->assignRelatedProduct($serviceId, $parentType, $request->realated);



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
     * get related product
     * @return Response
     */
    public function relatedProducts($serviceId) {
        $parentType = 2;
        $response = $this->relatedProductRepo->getRelatedProductList($serviceId, $parentType);
        return $response;
    }

    /**
     * save business other components
     * @return Response
     */
    public function saveComponents($request, $oldComponents) {
        try {

            $srvsId = $request->service_id;


            //save photo text
            $this->_savePhotoText($request->com_pt_text, $request->com_pt_photo, $srvsId, $oldComponents);

            //save package comparison one
            $p1Head = $request->com_pc1_table_head;
            $p1Text = $request->com_pc1_feature_text;
            $p1Price = $request->com_pc1_price;
            $this->_savePackageOne($p1Head, $p1Text, $p1Price, $srvsId, $oldComponents);


            //save package comparison two
            $p2Title = $request->com_pk2_title;
            $p2Name = $request->com_pk2_name;
            $p2Data = $request->com_pk2_data;
            $p2Days = $request->com_pk2_days;
            $p2Price = $request->com_pk2_price;
            $this->_savePackageTwo($p2Title, $p2Name, $p2Data, $p2Days, $p2Price, $srvsId, $oldComponents);

            //save package features
            $features = $request->com_ft_text;
            $this->_saveServiceFeature($features, $srvsId, $oldComponents);

            //save product price table data
            $ptTitle = $request->com_price_title;
            $ptHead = $request->com_price_head;
            $ptColOne = $request->com_price_column_one;
            $ptColTwo = $request->com_price_column_two;
            $ptColThree = $request->com_price_column_three;
            $this->_saveProductPrice($ptTitle, $ptHead, $ptColOne, $ptColTwo, $ptColThree, $srvsId, $oldComponents);

            //save video component
            $videoName = $request->com_vid_name;
            $videoTitle = $request->com_vid_title;
            $videoEmbed = $request->com_vid_embed;
            $videoDes = $request->com_vid_description;
            $this->_saveVideoComponent($videoName, $videoTitle, $videoEmbed, $videoDes, $srvsId, $oldComponents);


            //save photo component
            $photoOne = $request->com_photo_one;
            $photoTwo = $request->com_photo_two;
            $photoThree = $request->com_photo_three;
            $photoFour = $request->com_photo_four;
            $this->_savePhotoComponent($photoOne, $photoTwo, $photoThree, $photoFour, $srvsId, $oldComponents);

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
    private function _savePhotoText($text, $photo, $serviceId, $oldComponents) {
        if (!empty($text)) {
            foreach ($text as $position => $t) {
                $photoVal = $photo[$position];
                $bannerPath = $this->upload($photoVal, 'assetlite/images/business-images');
                $this->photoTextRepo->saveComponent($position, $t, $bannerPath, $serviceId, $oldComponents);
            }
        }
    }

    //save package comparison one
    private function _savePackageOne($p1Head, $p1Text, $p1Price, $srvsId, $oldComponents) {
        if (!empty($p1Head)) {
            foreach ($p1Head as $position => $head) {
                $ftText = $p1Text[$position];
                $price = $p1Price[$position];
                $this->pkOneRepo->saveComponent($position, $head, $ftText, $price, $srvsId, $oldComponents);
            }
        }
    }

    //save package comparison two
    private function _savePackageTwo($p2Title, $p2Name, $p2Data, $p2Days, $p2Price, $srvsId, $oldComponents) {
        if (!empty($p2Title)) {
            foreach ($p2Title as $position => $title) {
                $name = $p2Name[$position];
                $data = $p2Data[$position];
                $days = $p2Days[$position];
                $price = $p2Price[$position];
                $this->pkTwoRepo->saveComponent($position, $title, $name, $data, $days, $price, $srvsId, $oldComponents);
            }
        }
    }

    //save service features
    private function _saveServiceFeature($features, $srvsId, $oldComponents) {
        if (!empty($features)) {
            foreach ($features as $position => $ft) {
                $this->featureRepo->saveComponent($position, $ft, $srvsId, $oldComponents);
            }
        }
    }

    //save product price table
    private function _saveProductPrice($ptTitle, $ptHead, $ptColOne, $ptColTwo, $ptColThree, $srvsId, $oldComponents) {
        if (!empty($ptTitle)) {
            foreach ($ptTitle as $position => $title) {
                $head = $ptHead[$position];
                $colOne = $ptColOne[$position];
                $colTwo = $ptColTwo[$position];
                $colThree = $ptColThree[$position];
                $this->priceTableRepo->saveComponent($position, $title, $head, $colOne, $colTwo, $colThree, $srvsId, $oldComponents);
            }
        }
    }

    //save video component
    private function _saveVideoComponent($videoName, $videoTitle, $videoEmbed, $videoDes, $srvsId, $oldComponents) {
        if (!empty($videoName)) {
            foreach ($videoName as $position => $name) {
                $title = $videoTitle[$position];
                $embed = $videoEmbed[$position];
                $description = $videoDes[$position];
                $this->videoRepo->saveComponent($position, $name, $title, $embed, $description, $srvsId, $oldComponents);
            }
        }
    }

    //save video component
    private function _savePhotoComponent($photoOne, $photoTwo, $photoThree, $photoFour, $srvsId, $oldComponents) {
        if (!empty($photoOne)) {
            foreach ($photoOne as $position => $pOne) {
                $pTwo = $photoTwo[$position];
                $pThree = $photoThree[$position];
                $pFour = $photoFour[$position];

                $onePath = $this->upload($pOne, 'assetlite/images/business-images');
                $twoPath = $this->upload($pTwo, 'assetlite/images/business-images');
                $threePath = $this->upload($pThree, 'assetlite/images/business-images');
                $fourPath = $this->upload($pFour, 'assetlite/images/business-images');

                $this->photoRepo->saveComponent($position, $onePath, $twoPath, $threePath, $fourPath, $srvsId, $oldComponents);
            }
        }
    }

    /**
     * Get components by service ID
     * @return Response
     */
    public function getComponents($serviceId) {

        $components = [];
        $photoText = $this->photoTextRepo->getComponent($serviceId);
        foreach ($photoText as $v) {
            $components[$v->position]['type'] = 'Photo with Text';
            $components[$v->position]['id'] = $v->id;
            $components[$v->position]['text'] = $v->text;
            $components[$v->position]['photo_url'] = $v->photo_url;
        }

        $packageOne = $this->pkOneRepo->getComponent($serviceId);

        foreach ($packageOne as $v) {
            $components[$v->position]['type'] = 'Package Comparison One';
            $components[$v->position]['id'] = $v->ids;
            $components[$v->position]['text'] = $v->heads;
            $components[$v->position]['photo_url'] = "";
        }

        $packageTwo = $this->pkTwoRepo->getComponent($serviceId);

        foreach ($packageTwo as $v) {
            $components[$v->position]['type'] = 'Package Comparison Two';
            $components[$v->position]['id'] = $v->ids;
            $components[$v->position]['text'] = $v->name;
            $components[$v->position]['photo_url'] = "";
        }


        $features = $this->featureRepo->getComponent($serviceId);

        foreach ($features as $v) {
            $components[$v->position]['type'] = 'Product Features';
            $components[$v->position]['id'] = $v->id;
            $components[$v->position]['text'] = $v->feature_text;
            $components[$v->position]['photo_url'] = "";
        }


        $priceTable = $this->priceTableRepo->getComponent($serviceId);

        foreach ($priceTable as $v) {
            $headArray = json_decode($v->table_head);
            $head = implode(', ', $headArray);
            $components[$v->position]['type'] = 'Product Price Table';
            $components[$v->position]['id'] = $v->id;
            $components[$v->position]['text'] = $head;
            $components[$v->position]['photo_url'] = "";
        }


        $video = $this->videoRepo->getComponent($serviceId);
        foreach ($video as $v) {
            $components[$v->position]['type'] = 'Video Component';
            $components[$v->position]['id'] = $v->id;
            $components[$v->position]['text'] = $v->title;
            $components[$v->position]['photo_url'] = "";
        }



        $photos = $this->photoRepo->getComponent($serviceId);

        foreach ($photos as $v) {
            $components[$v->position]['type'] = 'Photo Component';
            $components[$v->position]['id'] = $v->id;
            $components[$v->position]['text'] = "";
            $components[$v->position]['photo_url'] = "";
            $components[$v->position]['photo1'] = $v->photo_one;
            $components[$v->position]['photo2'] = $v->photo_two;
            $components[$v->position]['photo3'] = $v->photo_three;
            $components[$v->position]['photo4'] = $v->photo_four;
        }

        ksort($components);

        return $components;
    }

    public function getSingleComponent($serviceId, $position, $type) {
        try {
            if ($type == "Photo with Text") {
                return $this->photoTextRepo->singleComponent($serviceId, $position);
            }
            if ($type == "Package Comparison One") {
                return $this->pkOneRepo->singleComponent($serviceId, $position);
            }
            if ($type == "Package Comparison Two") {
                return $this->pkTwoRepo->singleComponent($serviceId, $position);
            }
            if ($type == "Product Features") {
                return $this->featureRepo->singleComponent($serviceId, $position);
            }
            if ($type == "Product Price Table") {
                return $this->priceTableRepo->singleComponent($serviceId, $position);
            }
            if ($type == "Video Component") {
                return $this->videoRepo->singleComponent($serviceId, $position);
            }
            if ($type == "Photo Component") {
                return $this->photoRepo->singleComponent($serviceId, $position);
            }
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    /**
     * update business other components
     * @return Response
     */
    public function updateComponents($request) {
        try {

            $type = $request->type;

            if ($type == "photo-text") {

                $photoUrl = $request->old_photo;
                if ($request->photo) {
                    $photoUrl = $this->upload($request->photo, 'assetlite/images/business-images');
                    $this->deleteFile($request->old_photo);
                }
                $this->photoTextRepo->updateComponent($photoUrl, $request);
            }

            if ($type == "package-comparison-one") {
                $this->pkOneRepo->updateComponent($request);
            }
            if ($type == "package-comparison-two") {
                return $this->pkTwoRepo->singleComponent($serviceId, $position);
            }
            if ($type == "product-features") {
                return $this->featureRepo->singleComponent($serviceId, $position);
            }
            if ($type == "product-price-table") {
                return $this->priceTableRepo->singleComponent($serviceId, $position);
            }
            if ($type == "video-component") {
                return $this->videoRepo->singleComponent($serviceId, $position);
            }
            if ($type == "photo-component") {
                return $this->photoRepo->singleComponent($serviceId, $position);
            }

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

    public function deleteComponent($serviceId, $position, $type) {
        try {
            if ($type == "Photo with Text") {
                $this->photoTextRepo->deleteComponent($serviceId, $position);
            }
            if ($type == "Package Comparison One") {
                $this->pkOneRepo->deleteComponent($serviceId, $position);
            }
            if ($type == "Package Comparison Two") {
                $this->pkTwoRepo->deleteComponent($serviceId, $position);
            }
            if ($type == "Product Features") {
                $this->featureRepo->deleteComponent($serviceId, $position);
            }
            if ($type == "Product Price Table") {
                $this->priceTableRepo->deleteComponent($serviceId, $position);
            }
            if ($type == "Video Component") {
                $this->videoRepo->deleteComponent($serviceId, $position);
            }
            if ($type == "Photo Component") {
                $this->photoRepo->deleteComponent($serviceId, $position);
            }


            $response = [
                'success' => 1,
                'message' => "Deleted",
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
     * Change package sorting
     * @return Response
     */
    public function changeComponentSort($request) {
        try {
            $positions = $request->position;

            foreach ($positions as $position) {
                $comId = $position['id'];
                $newPosition = $position['position'];
                $oldPosition = $position['old_position'];
                $type = $position['type'];

//                echo $oldPosition;
//                echo " -- ";

                if ($type == "Photo with Text") {
                    $this->photoTextRepo->changePosition($comId, $newPosition);
                }
                if ($type == "Package Comparison One") {
                    $comIds = explode(',', $comId);
                    $this->pkOneRepo->changePosition($comIds, $newPosition);
                }
                if ($type == "Package Comparison Two") {
                    $comIds = explode(',', $comId);
                    $this->pkTwoRepo->changePosition($comIds, $newPosition);
                }
                if ($type == "Product Features") {
                    $this->featureRepo->changePosition($comId, $newPosition);
                }
                if ($type == "Product Price Table") {
                    $this->priceTableRepo->changePosition($comId, $newPosition);
                }
                if ($type == "Video Component") {
                    $this->videoRepo->changePosition($comId, $newPosition);
                }
                if ($type == "Photo Component") {
                    $this->photoRepo->changePosition($comId, $newPosition);
                }
            }
            $response = [
                'success' => 1,
                'message' => "Sort Changed",
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
     * Change service home show status
     * @return Response
     */
    public function homeStatusChange($serviceId) {
        $response = $this->otherRepo->changeHomeShowStatus($serviceId);
        return $response;
    }
    /**
     * Change service home show status
     * @return Response
     */
    public function homeSlider($serviceId) {
        $response = $this->otherRepo->assignHomeSlider($serviceId);
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
        $types = array("business-solution" => 2, "iot" => 3, "others" => 4);
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
                'name_en' => 'required',
                'name_bn' => 'required',
                'short_details_en' => 'required',
                'short_details_bn' => 'required',
            ]);

            //banner file replace in storege
            $bannerPath = "";
            if ($request['banner_photo'] != "") {
                $bannerPath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');

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

            $types = array("business-solution" => 2, "iot" => 3, "others" => 4);
            $parentTypes = $types[$request->type];
            $this->asgnFeatureRepo->assignFeature($request->service_id, $parentTypes, $request->feature);

            $parentType = 2;
            $this->relatedProductRepo->assignRelatedProduct($request->service_id, $parentType, $request->realated);

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
