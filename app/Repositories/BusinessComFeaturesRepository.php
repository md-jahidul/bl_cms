<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComFeatures;

class BusinessComFeaturesRepository extends BaseRepository {

    public $modelName = BusinessComFeatures::class;

    public function saveComponent($position, $ftTitleEn, $ftTitleBn, $featureEn, $featureBn, $serviceId, $oldComponents) {
        $this->model->insert(
                array(
                    "title_bn" => $ftTitleBn[$position],
                    "title_en" => $ftTitleEn[$position],
                    "feature_text" => $featureEn[$position],
                    "feature_text_bn" => $featureBn[$position],
                    "position" => $position + $oldComponents,
                    "service_id" => $serviceId
                )
        );
    }

    public function getComponent($serviceId) {
        $component = $this->model->where('service_id', $serviceId)->get();
        return $component;
    }

    public function deleteComponent($serviceId, $position) {
        $component = $this->model->where(array('service_id' => $serviceId, 'position' => $position))->delete();
        return $component;
    }

    public function singleComponent($serviceId, $position) {
        $component = $this->model->where(array('service_id' => $serviceId, 'position' => $position))->first();
        return $component;
    }

    public function updateComponent($request) {

        $comId = $request->com_id;


        $component = $this->model->where(array('id' => $comId))
                ->update(
                array(
                    'title_bn' => $request->title_bn,
                    'title_en' => $request->title_en,
                    'feature_text' => $request->feature_text_en,
                    'feature_text_bn' => $request->feature_text_bn,
                )
        );

        return $component;
    }

    public function changePosition($comId, $newPosition) {
        $component = $this->model->where(array('id' => $comId))
                ->update(array('position' => $newPosition));
        return $component;
    }

}
