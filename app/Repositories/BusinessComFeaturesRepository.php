<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComFeatures;

class BusinessComFeaturesRepository extends BaseRepository {

    public $modelName = BusinessComFeatures::class;

    public function saveComponent($position, $feature, $serviceId) {
        $this->model->insert(
                array(
                    "feature_text" => $feature,
                    "position" => $position,
                    "service_id" => $serviceId
                )
        );
    }

}
