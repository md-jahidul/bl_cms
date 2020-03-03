<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComFeatures;

class BusinessComFeaturesRepository extends BaseRepository {

    public $modelName = BusinessComFeatures::class;

    public function saveComponent($position, $feature, $serviceId, $oldComponents) {
        $this->model->insert(
                array(
                    "feature_text" => $feature,
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
        $featureTextEn = $request->feature_text_en;
        $featureTextBn = $request->feature_text_bn;


        $component = $this->model->where(array('id' => $comId))
                ->update(
                array(
                    'feature_text' => $featureTextEn,
                    'feature_text_bn' => $featureTextBn,
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
