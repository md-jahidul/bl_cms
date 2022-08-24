<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\CorpCaseStudyComponentRepository;
use App\Repositories\CorporateCaseStudySectionRepository;
use App\Repositories\CorpCaseStudyDetailsBannerRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class CorpCaseStudyComponentService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var CorpCaseStudyComponentRepository
     */
    private $corpCaseStudyComponentRepo;
    /**
     * @var CorporateCaseStudySectionRepository
     */
    private $caseStudySectionRepository;
    /**
     * @var CorpCaseStudyDetailsBannerRepository
     */
    private $bannerRepository;

    /**
     * DigitalServicesService constructor.
     * @param CorpCaseStudyComponentRepository $corpCaseStudyComponentRepository
     * @param CorporateCaseStudySectionRepository $caseStudySectionRepository
     * @param CorpCaseStudyDetailsBannerRepository $bannerRepository
     */
    public function __construct(
        CorpCaseStudyComponentRepository $corpCaseStudyComponentRepository,
        CorporateCaseStudySectionRepository $caseStudySectionRepository,
        CorpCaseStudyDetailsBannerRepository $bannerRepository
    ) {
        $this->corpCaseStudyComponentRepo = $corpCaseStudyComponentRepository;
        $this->caseStudySectionRepository = $caseStudySectionRepository;
        $this->bannerRepository = $bannerRepository;
        $this->setActionRepository($corpCaseStudyComponentRepository);
    }

    public function getSectionWiseComponent($sectionId)
    {
        return $this->corpCaseStudyComponentRepo->findByProperties(['section_id' => $sectionId]);
    }

    /**
     * Storing the alFaq resource
     * @param $data
     * @param $pageType
     * @param $sectionId
     * @return Response
     */
    public function storeComponent($data, $sectionId)
    {
        $components = $this->getSectionWiseComponent($sectionId);

        $section = $this->caseStudySectionRepository->findOne($sectionId);


        if ($section->section_type !== "top_image_button_text" && count($components) != 0) {
            return new Response("Component already exists. This is a single component section");
        }

        $directory = 'assetlite/images/corporate-responsibility';
        if (isset($data['base_image'])) {
            $data['base_image'] = $this->upload($data['base_image'], $directory);
        }
        $data['section_id'] = $sectionId;
        $this->save($data);
        return new Response("Component has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateComponent($data, $sectionId, $id)
    {
        $component = $this->findOne($id);

        $directory = 'assetlite/images/corporate-responsibility';
        if (isset($data['base_image'])) {
            $data['base_image'] = $this->upload($data['base_image'], $directory);
            $this->deleteFile($component->base_image);
        }
        // get original data
        $new_multiple_attributes = $component->other_attributes;
//         contains all the inputs from the form as an array
        $input_multiple_attributes = isset($result) ? $result : null;
//         loop over the product array
        if ($input_multiple_attributes) {
            foreach ($input_multiple_attributes as $data_id => $inputData) {
                foreach ($inputData as $key => $value) {
                    // set the new value
                    $new_multiple_attributes[$key] = $value;
                }
            }
        }

        $data['other_attributes'] = $new_multiple_attributes;
        $component->update($data);
        return Response('Component has been successfully updated');
    }

    /**
     * @param $request
     * @return string
     */
    public function tableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $component_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->findOne($component_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }

    public function bannerImageUpload($data)
    {
        $banner = $this->bannerRepository->findOneByProperties(['details_id' => $data['section_component_id']]);

        if ($banner) {
            request()->validate([
                'image_name_en' => 'required|unique:corp_case_study_details_banners,image_name_en,' . $banner->id,
                'image_name_bn' => 'required|unique:corp_case_study_details_banners,image_name_bn,' . $banner->id,
            ]);
        } else {
            request()->validate([
                'image_name_en' => 'required|unique:corp_case_study_details_banners,image_name_en',
                'image_name_bn' => 'required|unique:corp_case_study_details_banners,image_name_bn',
            ]);
        }

        $directory = 'assetlite/images/banner/corporate-responsibility';
        if (!empty($data['banner_web'])) {
            $data['banner_web'] = $this->upload($data['banner_web'], $directory);
            $filePath = isset($banner->banner_web) ? $banner->banner_web : null;
            $this->deleteFile($filePath);
        }

        if (!empty($data['banner_mobile'])) {
            $data['banner_mobile'] = $this->upload($data['banner_mobile'], $directory);
            $filePath = isset($banner->banner_mobile) ? $banner->banner_mobile : null;
            $this->deleteFile($filePath);
        }
        $data['details_id'] = $data['section_component_id'];
        ($banner) ? $banner->update($data) : $this->bannerRepository->save($data);
        return Response('Details Banner image has been successfully updated');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteComponent($id)
    {
        $component = $this->findOne($id);
        $filePath = isset($component->other_attributes['thumbnail_image']) ? $component->other_attributes['thumbnail_image'] : null;
        $this->deleteFile($filePath);
        $component->delete();
        return Response('Component has been successfully deleted');
    }
}
