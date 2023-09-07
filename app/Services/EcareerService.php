<?php

namespace App\Services;

use App\Repositories\EcareerPortalRepository;
use App\Repositories\EcareerPortalItemRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Carbon\Carbon;

class EcareerService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $ecarrerPortalService
     */
    protected $ecarrerPortalRepository;

    /**
     * [$ecarrerPortalItemRepository description]
     * @var [type]
     */
    protected $ecarrerPortalItemRepository;

    /**
     * PrizeService constructor.
     * @param PrizeRepository $prizeRepository
     */
    public function __construct(EcareerPortalRepository $ecarrerPortalRepository, EcareerPortalItemRepository $ecarrerPortalItemRepository) {
        $this->ecarrerPortalRepository = $ecarrerPortalRepository;
        $this->ecarrerPortalItemRepository = $ecarrerPortalItemRepository;
        $this->setActionRepository($ecarrerPortalRepository);
    }

    /**
     * store general section parent item on create
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    // public function storeEcarrerGeneralSection($data){
    //     # Life at Banglalink General section
    //     $data['category'] = 'life_at_bl_general';
    //     # This section has child item available
    //     $data['has_items'] = 1;
    //     $data['slug'] = str_replace(" ", "_", strtolower($data['slug']));
    //     if (!empty($data['image_url'])) {
    //         $data['image'] = $this->upload($data['image_url'], 'assetlite/images/ecarrer/general_section');
    //     }
    //     $this->save($data);
    //     return new Response('Section created successfully');
    // }

    /**
     * Get all general section for life of banglalink
     * @return [type] [description]
     */
    public function generalSections() {

        return $this->ecarrerPortalRepository->getSectionsByCategory('life_at_bl_general');
    }

    /**
     * General section by ID
     * @return [type] [description]
     */
    public function generalSectionById($id) {

        return $this->findOne($id);
    }

    /**
     * [updateEcarrerGeneralSection description]
     * @param  [type] $data [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    // public function updateEcarrerGeneralSection($data, $id)
    // {
    //     $general_section = $this->findOne($id);
    //     $data['slug'] = str_replace(" ", "_", strtolower($data['slug']));
    //     if (!empty($data['image_url'])) {
    //         $data['image'] = $this->upload($data['image_url'], 'assetlite/images/ecarrer/general_section');
    //     }
    //     $general_section->update($data);
    //     return Response('Section updated successfully');
    // }



    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function sectionDelete($id) {
        $section = $this->findOne($id);
        $data['deleted_at'] = Carbon::now();
        $section->update($data);

        $this->ecarrerPortalItemRepository->sectionItemSoftDeleteBySectionID($id);

        return Response('Section deleted successfully !');
    }

    /**
     * Life at bl teams sections
     * @return [type] [description]
     */
    public function ecarrerSectionsList($categoryTypes) {

        return $this->ecarrerPortalRepository->getSectionsByCategory($categoryTypes);
    }

    /**
     * store teams section on create
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function storeEcarrerSection($data, $data_types = null) {

        # Life at Banglalink General section
        $data['category'] = !empty($data_types['category']) ? $data_types['category'] : null;
        # This section has child item available
        $data['has_items'] = !empty($data_types['has_items']) ? $data_types['has_items'] : 0;
        $data['route_slug'] = !empty($data_types['route_slug']) ? $data_types['route_slug'] : null;
        $data['additional_info'] = !empty($data_types['additional_info']) ? $data_types['additional_info'] : null;

        if (!empty($data['slug'])) {
            $data['slug'] = str_replace(" ", "_", strtolower($data['slug']));
        }

        if (!empty($data['image_url'])) {
            $data['image'] = $this->upload($data['image_url'], 'assetlite/images/ecarrer/general_section');
        }
        $call_to_action_buttons = [];
        if ( isset($data['call_to_action_label_en_1']) && !empty($data['call_to_action_label_en_1']) ) {

            if( !empty($data['call_to_action_count'])){

                for ($i=1; $i <= $data['call_to_action_count']; $i++) {

                    $buttons = [];

                    if( isset($data['call_to_action_label_en_'.$i]) ){
                        $buttons['label_en'] = $data['call_to_action_label_en_'.$i];
                    }

                    if( isset($data['call_to_action_label_bn_'.$i]) ){
                        $buttons['label_bn'] = $data['call_to_action_label_bn_'.$i];
                    }

                    if( isset($data['call_to_action_url_'.$i]) ){
                        $buttons['link'] = $data['call_to_action_url_'.$i];
                    }

                    if( isset($data['call_to_action_url_bn_'.$i]) ){
                        $buttons['link_bn'] = $data['call_to_action_url_bn_'.$i];
                    }

                    if( !empty($buttons) ){
                        $call_to_action_buttons['button_'.$i] = $buttons;
                    }

                }
            }
        }

        if( !empty($call_to_action_buttons) ){
            $data['call_to_action'] = serialize($call_to_action_buttons);
        }
        else{
            $data['call_to_action'] = null;
        }
        $this->save($data);
        return new Response('Section created successfully');
    }

    /**
     * [updateEcarrerGeneralSection description]
     * @param  [type] $data [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function updateEcarrerSection($data, $id, $data_types = null) {

        $general_section = $this->findOne($id);

        if (!empty($data['slug'])) {
            $data['slug'] = str_replace(" ", "_", strtolower($data['slug']));
        }

        if (!empty($data['image_url'])) {

            $data['image'] = $this->upload($data['image_url'], 'assetlite/images/ecarrer/general_section');
        }

        if (isset($data_types['has_items'])) {
            $data['has_items'] = $data_types['has_items'];
        }
        $call_to_action_buttons = [];
        if ( isset($data['call_to_action_label_en_1']) && !empty($data['call_to_action_label_en_1']) ) {

            if( !empty($data['call_to_action_count'])){

                for ($i=1; $i <= $data['call_to_action_count']; $i++) {

                    $buttons = [];

                    if( isset($data['call_to_action_label_en_'.$i]) ){
                        $buttons['label_en'] = $data['call_to_action_label_en_'.$i];
                    }

                    if( isset($data['call_to_action_label_bn_'.$i]) ){
                        $buttons['label_bn'] = $data['call_to_action_label_bn_'.$i];
                    }

                    if( isset($data['call_to_action_url_'.$i]) ){
                        $buttons['link'] = $data['call_to_action_url_'.$i];
                        $buttons['external_site'] = strpos($data['call_to_action_url_'.$i], 'http') !== false ? 1 : 0;
                    }

                    if( isset($data['call_to_action_url_bn_'.$i]) ){
                        $buttons['link_bn'] = $data['call_to_action_url_bn_'.$i];
                        $buttons['external_site'] = strpos($data['call_to_action_url_bn_'.$i], 'http') !== false ? 1 : 0;
                    }

                    if( !empty($buttons) ){
                        $call_to_action_buttons['button_'.$i] = $buttons;
                    }

                }
            }
        }

        if( !empty($call_to_action_buttons) ){
            $data['call_to_action'] = serialize($call_to_action_buttons);
        }
        else{
            $data['call_to_action'] = null;
        }

        if( !empty($data['additional_info'])  ){
            $data['additional_info'] = json_encode($data['additional_info']);
        }
        $data['additional_info'] = !empty($data_types['additional_info']) ? $data_types['additional_info'] : null;

        $general_section->update($data);

        return Response('Section updated successfully');
    }

    /**
     * [updateEcarrerGeneralSection description]
     * @param  [type] $data [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function updateMainSection($data, $id) {
        try {
            $status = true;

            $update['title_en'] = $data['title_en'];
            $update['title_bn'] = $data['title_bn'];
            $update['alt_text'] = $data['alt_text'];
            $update['alt_text_bn'] = $data['alt_text_bn'];
            $update['banner_name'] = $data['banner_name'];
            $update['banner_name_bn'] = $data['banner_name_bn'];
            $update['page_header'] = $data['page_header'];
            $update['page_header_bn'] = $data['page_header_bn'];
            $update['schema_markup'] = $data['schema_markup'];
            $update['route_slug'] = $data['route_slug'];
            $update['route_slug_bn'] = $data['route_slug_bn'];
            $update['is_active'] = $data['is_active'];


            if (!empty($data['slug'])) {
                $update['slug'] = str_replace(" ", "_", strtolower($data['slug']));
            }

            if (!empty($data['image_url'])) {
                $photoName = $data['banner_name'] . '-web';

                $update['image'] = $this->upload($data['image_url'], 'assetlite/images/ecarrer/general_section', $photoName);

                $status = $update['image'];

                //delete old web photo
                if ($data['old_web_img']) {
                    $this->deleteFile($data['old_web_img']);
                }
            }

            if (!empty($data['image_url_mobile'])) {
                $photoName = $data['banner_name'] . '-mobile';

                $update['image_mobile'] = $this->upload($data['image_url_mobile'], 'assetlite/images/ecarrer/general_section', $photoName);

                $status = $update['image_mobile'];

                //delete old web photo
                if ($data['old_mob_img']) {
                    $this->deleteFile($data['old_mob_img']);
                }
            }

            //only rename

            if ($data['old_banner_name'] != $data['banner_name']) {
                //rename web
                if (empty($data['image_url'])) {
                    $fileName = $data['banner_name'] . '-web';
                    $directoryPath = 'assetlite/images/ecarrer/general_section';
                    $update['image'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
                    $status = $update['image'];
                }

                if (empty($data['image_url_mobile'])) {
                    $fileName = $data['banner_name'] . '-mobile';
                    $directoryPath = 'assetlite/images/ecarrer/general_section';
                    $update['image_mobile'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);

                    $status = $update['image_mobile'];
                }
            }

            if ($status != false) {
                $this->ecarrerPortalRepository->updateMainSection($update, $id);

                $response = [
                    'success' => 1,
                ];
            } else {
                $response = [
                    'success' => 2,
                ];
            }




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
     * [updateEcarrerGeneralSection description]
     * @param  [type] $data [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function updateSubSection($data, $id) {
        try {

            $update['title_en'] = $data['title_en'];
            $update['title_bn'] = $data['title_bn'];
            $update['description_en'] = $data['description_en'];
            $update['description_bn'] = $data['description_bn'];
            $update['page_header'] = $data['page_header'];
            $update['page_header_bn'] = $data['page_header_bn'];
            $update['schema_markup'] = $data['schema_markup'];
            $update['route_slug'] = $data['route_slug'];
            $update['route_slug_bn'] = $data['route_slug_bn'];
            $update['is_active'] = $data['is_active'];

            $this->ecarrerPortalRepository->updateMainSection($update, $id);


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
     * [getRouteSlug description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getRouteSlug($path, $additional_route_param = null) {
        if (!empty($path)) {
            $match = explode('/', $path);
            if (!empty($match[0]) && !empty($match[1])) {

                if (!empty($additional_route_param)) {
                    return $match[0] . '/' . $match[1] . '/' . $additional_route_param;
                } else {
                    return $match[0] . '/' . $match[1];
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($position)
    {
        $this->ecarrerPortalRepository->sortData($position);
        return new Response('update successfully');
    }

    public function findProgramId(){
        //return
        $programId = $this->ecarrerPortalRepository->findProgramId();
        if(isset($programId)){
            return $this->ecarrerPortalItemRepository->findProgramList($programId->id);
        }
    }

    public function getSeoData()
    {
        return $this->ecarrerPortalRepository->findOneByProperties(['category_type' => 'life_at_banglalink']);
    }

    public function getSeoForDetails()
    {
        return $this->ecarrerPortalRepository->findOneByProperties(['category_type' => 'life_at_banglalink']);
    }

    public function seoSaveOrUpdate($data)
    {
        $careerSeoLandingPg = $this->getSeoData();
        if ($careerSeoLandingPg) {
            $careerSeoLandingPg->update($data);
        } else {
            $data['category_type'] = 'life_at_banglalink';
            $this->save($data);
        }
        return new Response('SEO data save successfully');
    }
}
