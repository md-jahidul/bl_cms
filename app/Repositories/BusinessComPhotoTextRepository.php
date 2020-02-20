<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessPhotoText;

class BusinessComPhotoTextRepository extends BaseRepository {

    public $modelName = BusinessPhotoText::class;

    public function saveComponent($position, $text, $bannerPath, $serviceId) {
        $this->model->insert(
                array(
                    "text" => $text,
                    "photo_url" => $bannerPath,
                    "position" => $position,
                    "service_id" => $serviceId
                )
        );
    }

}
