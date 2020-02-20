<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComPhoto;

class BusinessComPhotoRepository extends BaseRepository {

    public $modelName = BusinessComPhoto::class;

    public function saveComponent($position, $onePath, $twoPath, $threePath, $fourPath, $serviceId) {
        $this->model->insert(
                array(
                    "photo_one" => $onePath,
                    "photo_two" => $twoPath,
                    "photo_three" => $threePath,
                    "photo_four" => $fourPath,
                    "position" => $position,
                    "service_id" => $serviceId
                )
        );
    }

}
