<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Repositories\CorpCrStrategyComponentRepository;
use App\Repositories\CorporateCrStrategySectionRepository;
use App\Repositories\MediaPressNewsEventRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CorpCrStrategyComponentService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var CorpCrStrategyComponentRepository
     */
    private $corpCrStrategyComponentRepo;

    /**
     * DigitalServicesService constructor.
     * @param CorpCrStrategyComponentRepository $corpCrStrategyComponentRepository
     */
    public function __construct(CorpCrStrategyComponentRepository $corpCrStrategyComponentRepository)
    {
        $this->corpCrStrategyComponentRepo = $corpCrStrategyComponentRepository;
        $this->setActionRepository($corpCrStrategyComponentRepository);
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
