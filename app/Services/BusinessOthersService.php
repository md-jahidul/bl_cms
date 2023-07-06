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

            //file upload in storege

            $directoryPath = 'assetlite/images/business-images';


            $iconPath = "";
            if ($request['icon'] != "") {
                $iconPath = $this->upload($request['icon'], $directoryPath);
            }


            //product photo
            $photoNameWeb = $request['banner_name'] . '-web';
            $photoNameMob = $request['banner_name'] . '-mobile';
            $photoWeb = "";
            $photoMob = "";
            if (!empty($request['banner_photo'])) {

                $photoWeb = $this->upload($request['banner_photo'], $directoryPath, $photoNameWeb);
            }

            if (!empty($request['banner_mobile'])) {

                $photoMob = $this->upload($request['banner_mobile'], $directoryPath, $photoNameMob);
            }


            //details banner photo
            $bannerNameWeb = $request['details_banner_name'] . '-web';
            $bannerNameMob = $request['details_banner_name'] . '-mobile';
            $bannerWeb = "";
            $bannerMob = "";
            if (!empty($request['details_banner_web'])) {

                $bannerWeb = $this->upload($request['details_banner_web'], $directoryPath, $bannerNameWeb);
            }

            if (!empty($request['details_banner_mob'])) {

                $bannerMob = $this->upload($request['details_banner_mob'], $directoryPath, $bannerNameMob);
            }



            //save data in database
            $serviceId = $this->otherRepo->saveService($photoWeb, $photoMob, $bannerWeb, $bannerMob, $iconPath, $request);
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
            $ptTextEn = $request->com_pt_text_en;
            $ptTextBn = $request->com_pt_text_bn;
            $ptAlt = $request->com_pt_alt_text;
            $ptPhoto = $request->com_pt_photo;
            $this->_savePhotoText($ptTextEn, $ptTextBn, $ptAlt, $ptPhoto, $srvsId, $oldComponents);

            //save package comparison one
            $p1HeadEn = $request->com_pc1_table_head_en;
            $p1HeadBn = $request->com_pc1_table_head_bn;

            $p1TextEn = $request->com_pc1_feature_text_en;
            $p1TextBn = $request->com_pc1_feature_text_bn;

            $p1PriceEn = $request->com_pc1_price_en;
            $p1PriceBn = $request->com_pc1_price_bn;
            $this->_savePackageOne($p1HeadEn, $p1HeadBn, $p1TextEn, $p1TextBn, $p1PriceEn, $p1PriceBn, $srvsId, $oldComponents);


            //save package comparison two
            $p2data['p2TitleEn'] = $request->com_pk2_title_en;
            $p2data['p2TitleBn'] = $request->com_pk2_title_bn;

            $p2data['p2NameEn'] = $request->com_pk2_name_en;
            $p2data['p2NameBn'] = $request->com_pk2_name_bn;

            $p2data['p2DataEn'] = $request->com_pk2_data_en;
            $p2data['p2DataBn'] = $request->com_pk2_data_bn;

            $p2data['p2DaysEn'] = $request->com_pk2_days_en;
            $p2data['p2DaysBn'] = $request->com_pk2_days_bn;

            $p2data['p2PriceEn'] = $request->com_pk2_price_en;

            $this->_savePackageTwo($p2data, $srvsId, $oldComponents);

            //save package features
            $ftTitleEn = $request->com_ft_title_en;
            $ftTitleBn = $request->com_ft_title_bn;
            $featureEn = $request->com_ft_text_en;
            $featureBn = $request->com_ft_text_bn;
            $this->_saveServiceFeature($ftTitleEn, $ftTitleBn, $featureEn, $featureBn, $srvsId, $oldComponents);

            //save product price table data
            $pTable['ptTitleEn'] = $request->com_price_title_en;
            $pTable['ptTitleBn'] = $request->com_price_title_bn;

            $pTable['ptHeadEn'] = $request->com_price_head_en;
            $pTable['ptHeadBn'] = $request->com_price_head_bn;

            $pTable['ptColOneEn'] = $request->com_price_column_one_en;
            $pTable['ptColOneBn'] = $request->com_price_column_one_bn;

            $pTable['ptColTwoEn'] = $request->com_price_column_two_en;
            $pTable['ptColTwoBn'] = $request->com_price_column_two_bn;

            $pTable['ptColThreeEn'] = $request->com_price_column_three_en;
            $pTable['ptColThreeBn'] = $request->com_price_column_three_bn;

            $this->_saveProductPrice($pTable, $srvsId, $oldComponents);

            //save video component
            $vData['videoNameEn'] = $request->com_vid_name_en;
            $vData['videoNameBn'] = $request->com_vid_name_bn;

            $vData['videoTitleEn'] = $request->com_vid_title_en;
            $vData['videoTitleBn'] = $request->com_vid_title_bn;

            $vData['videoEmbed'] = $request->com_vid_embed;

            $vData['videoDesEn'] = $request->com_vid_description_en;
            $vData['videoDesBn'] = $request->com_vid_description_bn;
            $this->_saveVideoComponent($vData, $srvsId, $oldComponents);


            //save photo component
            $pcData['photoOne'] = $request->com_photo_one ? $request->com_photo_one : "";
            $pcData['photoOneAlt'] = $request->com_photo_one_alt;
            $pcData['photoTwo'] = $request->com_photo_two ? $request->com_photo_two : "";
            $pcData['photoTwoAlt'] = $request->com_photo_two_alt;
            $pcData['photoThree'] = $request->com_photo_three ? $request->com_photo_three : "";
            $pcData['photoThreeAlt'] = $request->com_photo_three_alt;
            $pcData['photoFour'] = $request->com_photo_four ? $request->com_photo_four : "";
            $pcData['photoFourAlt'] = $request->com_photo_four_alt;
            $this->_savePhotoComponent($pcData, $srvsId, $oldComponents);

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
    private function _savePhotoText($ptTextEn, $ptTextBn, $ptAlt, $ptPhoto, $serviceId, $oldComponents) {
        if (!empty($ptTextEn)) {
            foreach ($ptTextEn as $position => $textEn) {
                $textBn = $ptTextBn[$position];
                $altText = $ptAlt[$position];
                $photoVal = $ptPhoto[$position];
                $bannerPath = $this->upload($photoVal, 'assetlite/images/business-images');
                $this->photoTextRepo->saveComponent($position, $textEn, $textBn, $altText, $bannerPath, $serviceId, $oldComponents);
            }
        }
    }

    //save package comparison one
    private function _savePackageOne($p1HeadEn, $p1HeadBn, $p1TextEn, $p1TextBn, $p1PriceEn, $p1PriceBn, $srvsId, $oldComponents) {
        if (!empty($p1HeadEn)) {
            foreach ($p1HeadEn as $position => $head) {

                $hEn = $p1HeadEn[$position];
                $hBn = $p1HeadBn[$position];

                $tEn = $p1TextEn[$position];
                $tBn = $p1TextBn[$position];

                $pEn = $p1PriceEn[$position];

                $this->pkOneRepo->saveComponent($position, $hEn, $hBn, $tEn, $tBn, $pEn, $srvsId, $oldComponents);
            }
        }
    }

    //save package comparison two
    private function _savePackageTwo($p2data, $srvsId, $oldComponents) {

        if (!empty($p2data['p2TitleEn'])) {
            foreach ($p2data['p2TitleEn'] as $position => $val) {

                $data['p2TitleEn'] = $p2data['p2TitleEn'][$position];
                $data['p2TitleBn'] = $p2data['p2TitleBn'][$position];

                $data['p2NameEn'] = $p2data['p2NameEn'][$position];
                $data['p2NameBn'] = $p2data['p2NameBn'][$position];

                $data['p2DataEn'] = $p2data['p2DataEn'][$position];
                $data['p2DataBn'] = $p2data['p2DataBn'][$position];

                $data['p2DaysEn'] = $p2data['p2DaysEn'][$position];
                $data['p2DaysBn'] = $p2data['p2DaysBn'][$position];

                $data['p2PriceEn'] = $p2data['p2PriceEn'][$position];

                $this->pkTwoRepo->saveComponent($position, $data, $srvsId, $oldComponents);
            }
        }
    }

    //save service features
    private function _saveServiceFeature($ftTitleEn, $ftTitleBn, $featureEn, $featureBn, $srvsId, $oldComponents) {
        if (!empty($ftTitleEn)) {
            foreach ($ftTitleEn as $position => $val) {
                $this->featureRepo->saveComponent($position, $ftTitleEn, $ftTitleBn, $featureEn, $featureBn, $srvsId, $oldComponents);
            }
        }
    }

    //save product price table
    private function _saveProductPrice($pTable, $srvsId, $oldComponents) {





        if (!empty($pTable['ptTitleEn'])) {
            foreach ($pTable['ptTitleEn'] as $position => $title) {


                $data['ptTitleEn'] = $pTable['ptTitleEn'][$position];
                $data['ptTitleBn'] = $pTable['ptTitleBn'][$position];

                $data['ptHeadEn'] = $pTable['ptHeadEn'][$position];
                $data['ptHeadBn'] = $pTable['ptHeadBn'][$position];

                $data['ptColOneEn'] = $pTable['ptColOneEn'][$position];
                $data['ptColOneBn'] = $pTable['ptColOneBn'][$position];

                $data['ptColTwoEn'] = $pTable['ptColTwoEn'][$position];
                $data['ptColTwoBn'] = $pTable['ptColTwoBn'][$position];

                $data['ptColThreeEn'] = $pTable['ptColThreeEn'][$position];
                $data['ptColThreeBn'] = $pTable['ptColThreeBn'][$position];

                $this->priceTableRepo->saveComponent($position, $data, $srvsId, $oldComponents);
            }
        }
    }

    //save video component
    private function _saveVideoComponent($vData, $srvsId, $oldComponents) {



        if (!empty($vData['videoNameEn'])) {
            foreach ($vData['videoNameEn'] as $position => $name) {
                $data['videoNameEn'] = $vData['videoNameEn'][$position];
                $data['videoNameBn'] = $vData['videoNameBn'][$position];

                $data['videoTitleEn'] = $vData['videoTitleEn'][$position];
                $data['videoTitleBn'] = $vData['videoTitleBn'][$position];

                $data['videoEmbed'] = $vData['videoEmbed'][$position];

                $data['videoDesEn'] = $vData['videoDesEn'][$position];
                $data['videoDesBn'] = $vData['videoDesBn'][$position];

                $this->videoRepo->saveComponent($position, $data, $srvsId, $oldComponents);
            }
        }
    }

    //save video component
    private function _savePhotoComponent($pcData, $srvsId, $oldComponents) {


        if (!empty($pcData['photoOne'])) {
            foreach ($pcData['photoOne'] as $position => $val) {

                $pOne = !empty($pcData['photoOne']) ? $pcData['photoOne'][$position] : "";
                $pTwo = !empty($pcData['photoTwo']) ? $pcData['photoTwo'][$position] : "";
                $pThree = !empty($pcData['photoThree']) ? $pcData['photoThree'][$position] : "";
                $pFour = !empty($pcData['photoFour']) ? $pcData['photoFour'][$position] : "";

                $data['altOne'] = $pcData['photoOneAlt'][$position];
                $data['altTwo'] = $pcData['photoTwoAlt'][$position];
                $data['altThree'] = $pcData['photoThreeAlt'][$position];
                $data['altFour'] = $pcData['photoFourAlt'][$position];

                $data['onePath'] = !empty($pOne) ? $this->upload($pOne, 'assetlite/images/business-images') : "";
                $data['twoPath'] = !empty($pTwo) ? $this->upload($pTwo, 'assetlite/images/business-images') : "";
                $data['threePath'] = !empty($pThree) ? $this->upload($pThree, 'assetlite/images/business-images') : "";
                $data['fourPath'] = !empty($pFour) ? $this->upload($pFour, 'assetlite/images/business-images') : "";


                $this->photoRepo->saveComponent($position, $data, $srvsId, $oldComponents);
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
            $components[$v->position]['text'] = $v->title_en;
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
                $this->pkTwoRepo->updateComponent($request);
            }
            if ($type == "product-features") {
                $this->featureRepo->updateComponent($request);
            }
            if ($type == "product-price-table") {
                $this->priceTableRepo->updateComponent($request);
            }
            if ($type == "video-component") {
                $this->videoRepo->updateComponent($request);
            }
            if ($type == "photo-component") {

                $onePath = $request->old_photo_one;
                if ($request->photo_one) {
                    $onePath = $this->upload($request->photo_one, 'assetlite/images/business-images');
                    //delete old photo
                    if ($request->old_photo_one != "") {
                        $this->deleteFile($request->old_photo_one);
                    }
                }

                $twoPath = $request->old_photo_two;
                if ($request->photo_two) {
                    $twoPath = $this->upload($request->photo_two, 'assetlite/images/business-images');
                    //delete old photo
                    if ($request->old_photo_two != "") {
                        $this->deleteFile($request->old_photo_two);
                    }
                }

                $threePath = $request->old_photo_three;
                if ($request->photo_three) {
                    $threePath = $this->upload($request->photo_three, 'assetlite/images/business-images');
                    //delete old photo
                    if ($request->old_photo_three != "") {
                        $this->deleteFile($request->old_photo_three);
                    }
                }
                $fourPath = $request->old_photo_four;
                if ($request->photo_four) {
                    $fourPath = $this->upload($request->photo_four, 'assetlite/images/business-images');
                    //delete old photo
                    if ($request->old_photo_four != "") {
                        $this->deleteFile($request->old_photo_four);
                    }
                }

                $this->photoRepo->updateComponent($onePath, $twoPath, $threePath, $fourPath, $request);
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
    public function getServiceById($serviceId, $type = '') {
        $response = $this->otherRepo->getServiceById($serviceId, $type);
        return $response;
    }

    /**
     * Get business package by id
     * @return Response
     */
    public function getFeaturesByService($serviceType, $serviceId) {
        $types = array("business-solution" => 2, "iot" => 3, "others" => 4);
        $response = [];
        if (isset($types[$serviceType])) {
            $parentType = $types[$serviceType];
            $response = $this->asgnFeatureRepo->getAssignedFeatures($serviceId, $parentType);
        }
        return $response;
    }

    /**
     * update business landing page news
     * @return Response
     */
    public function updateService($request) {
        try {

            //banner file replace in storege
            $directoryPath = 'assetlite/images/business-images/';


            //icon file replace in storege
            $iconPath = "";
            if ($request['icon'] != "") {
                $iconPath = $this->upload($request['icon'], $directoryPath);

                //delete old photo
                if ($request['old_icon']) {
                    $this->deleteFile($request['old_icon']);
                }
            }

            //product photo

            $photoNameMob = $request['banner_name'] . '-mobile';
            $photoWeb = "";
            $photoMob = "";
            if (!empty($request['banner_photo'])) {
                $photoNameWeb = $request['banner_name'] . '-web.' .pathinfo($request->file('banner_photo')->getClientOriginalName(), PATHINFO_EXTENSION);;
                $request['old_banner'] != "" ? $this->deleteFile($request['old_banner']) : "";
                $photoWeb = $this->upload($request['banner_photo'], $directoryPath, $photoNameWeb);
            }

            if (!empty($request['banner_mobile'])) {

                $request['old_banner_mob'] != "" ? $this->deleteFile($request['old_banner_mob']) : "";
                $photoMob = $this->upload($request['banner_mobile'], $directoryPath, $photoNameMob);
            }

            //product photo rename
            if ($request['old_banner_name'] != $request['banner_name']) {

                if (empty($request['banner_photo'])) {
                    $photoWeb = $this->rename($request['old_banner'], $photoNameWeb, $directoryPath);
                }

                if (empty($request['banner_mobile'])) {
                    $photoMob = $this->rename($request['old_banner_mob'], $photoNameMob, $directoryPath);
                }
            }

            //details banner
            $bannerNameWeb = $request['details_banner_name'] . '-web';
            $bannerNameMob = $request['details_banner_name'] . '-mobile';
            $bannerWeb = "";
            $bannerMob = "";
            if (!empty($request['details_banner_web'])) {

                $request['old_details_banner_web'] != "" ? $this->deleteFile($request['old_details_banner_web']) : "";
                $bannerWeb = $this->upload($request['details_banner_web'], $directoryPath, $bannerNameWeb);
            }

            if (!empty($request['details_banner_mob'])) {

                $request['old_details_banner_mob'] != "" ? $this->deleteFile($request['old_details_banner_mob']) : "";
                $bannerMob = $this->upload($request['details_banner_mob'], $directoryPath, $bannerNameMob);
            }

            //details banner rename
            if ($request['old_details_banner_name'] != $request['details_banner_name']) {

                if (empty($request['details_banner_web'])) {
                    $bannerWeb = $this->rename($request['old_details_banner_web'], $bannerNameWeb, $directoryPath);
                }

                if (empty($request['details_banner_mob'])) {
                    $bannerMob = $this->rename($request['old_details_banner_mob'], $bannerNameMob, $directoryPath);
                }
            }

            //save data in database
            $this->otherRepo->updateService($photoWeb, $photoMob, $bannerWeb, $bannerMob, $iconPath, $request);

            $types = array("business-solution" => 2, "iot" => 3, "others" => 4);
            
            if(isset($types[$request->type])){
            $parentTypes = $types[$request->type];
            }else{
                $parentTypes = $request->type;
            }
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
                'message' => $e
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
