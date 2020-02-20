<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComVideo;

class BusinessComVideoRepository extends BaseRepository {

    public $modelName = BusinessComVideo::class;

    public function saveComponent($position, $name, $title, $embed, $description, $serviceId) {
        $this->model->insert(
                array(
                    "name" => $name,
                    "title" => $title,
                    "embed_code" => $embed,
                    "description" => $description,
                    "position" => $position,
                    "service_id" => $serviceId
                )
        );
    }

}
