<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\CorpCaseStudyComponentRepository;
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
     * DigitalServicesService constructor.
     * @param CorpCaseStudyComponentRepository $corpCaseStudyComponentRepository
     */
    public function __construct(CorpCaseStudyComponentRepository $corpCaseStudyComponentRepository)
    {
        $this->corpCaseStudyComponentRepo = $corpCaseStudyComponentRepository;
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
    public function storeComponent($data, $pageType, $sectionId)
    {
        $directory = 'assetlite/images/corporate-responsibility';
        if (isset($data['other_attributes']['thumbnail_image'])) {
            $data['other_attributes']['thumbnail_image'] = $this->upload($data['other_attributes']['thumbnail_image'], $directory);
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
//        $file = $data['other_attributes']['thumbnail_image'];
        if (!empty($data['other_attributes']['thumbnail_image'])) {
            $result['other_attributes']['thumbnail_image'] = $this->upload($data['other_attributes']['thumbnail_image'], $directory);
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
        $sectionComponent = $this->findOne($data['section_component_id']);

        $directory = 'assetlite/images/banner/corporate-responsibility';
        if (!empty($data['banner']['banner_image_url'])) {
            $data['banner']['banner_image_url'] = $this->upload($data['banner']['banner_image_url'], $directory);
            $filePath = isset($sectionComponent->banner['banner_image_url']) ? $sectionComponent->banner['banner_image_url'] : null;
            $this->deleteFile($filePath);
        }

        if (!empty($data['banner']['banner_mobile_view'])) {
            $data['banner']['banner_mobile_view'] = $this->upload($data['banner']['banner_mobile_view'], $directory);
            $filePath = isset($sectionComponent->banner['banner_mobile_view']) ? $sectionComponent->banner['banner_mobile_view'] : null;
            $this->deleteFile($filePath);
        }

        // get original data
        $new_multiple_attributes = $sectionComponent->banner;
//         contains all the inputs from the form as an array
        $input_multiple_attributes = isset($data['banner']) ? $data['banner'] : null;
//         loop over the product array

        if ($input_multiple_attributes) {
            foreach ($input_multiple_attributes as $key => $inputData) {
                $new_multiple_attributes[$key] = $inputData;
            }
        }
        unset($data['section_component_id']);
        $data['banner'] = $new_multiple_attributes;
        $sectionComponent->update($data);
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
