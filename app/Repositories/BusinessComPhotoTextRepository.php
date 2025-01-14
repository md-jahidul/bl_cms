<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessPhotoText;

class BusinessComPhotoTextRepository extends BaseRepository {

    public $modelName = BusinessPhotoText::class;

    public function saveComponent($position, $textEn,$textBn, $altText, $bannerPath, $serviceId, $oldComponents) {
        $this->model->insert(
                array(
                    "text" => $textEn,
                    "text_bn" => $textBn,
                    "photo_url" => $bannerPath,
                    "alt_text" => $altText,
                    "position" => $position + $oldComponents,
                    "service_id" => $serviceId
                )
        );
    }

    public function getComponent($serviceId) {
        $component = $this->model->where('service_id', $serviceId)->get();
        return $component;
    }

    public function singleComponent($serviceId, $position) {
        $component = $this->model->where(array('service_id' => $serviceId, 'position' => $position))->first();
        return $component;
    }

    public function updateComponent($photoUrl, $request) {
        $comId = $request->com_id;
        $component = $this->model->where(array('id' => $comId))
                ->update(
                array(
                    'text' => $request->text_en,
                    'text_bn' => $request->text_bn,
                    'photo_url' => $photoUrl,
                    'alt_text' => $request->alt_text,
                )
        );
        return $component;
    }

    public function deleteComponent($serviceId, $position) {
        $component = $this->model->where(array('service_id' => $serviceId, 'position' => $position))->delete();
        return $component;
    }

    public function changePosition($comId, $newPosition) {
        $component = $this->model->where(array('id' => $comId))
                ->update(array('position' => $newPosition));
        return $component;
    }

}
