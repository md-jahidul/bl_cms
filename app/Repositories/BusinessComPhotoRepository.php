<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComPhoto;

class BusinessComPhotoRepository extends BaseRepository {

    public $modelName = BusinessComPhoto::class;

    public function saveComponent($position, $onePath, $twoPath, $threePath, $fourPath, $serviceId, $oldComponents) {
        $this->model->insert(
                array(
                    "photo_one" => $onePath,
                    "photo_two" => $twoPath,
                    "photo_three" => $threePath,
                    "photo_four" => $fourPath,
                    "position" => $position + $oldComponents,
                    "service_id" => $serviceId
                )
        );
    }
    
    public function getComponent($serviceId) {
        $component = $this->model->where('service_id', $serviceId)->get();
        return $component;
    }
    
     public function deleteComponent($serviceId, $position){
        $component = $this->model->where(array('service_id' => $serviceId, 'position' => $position))->delete();
        return $component;
    }
    
    public function singleComponent($serviceId, $position) {
        $component = $this->model->where(array('service_id' => $serviceId, 'position' => $position))->first();
        return $component;
    }
    
    public function updateComponent($onePath, $twoPath, $threePath, $fourPath, $request){

        $comId = $request->com_id;


        $component = $this->model->where(array('id' => $comId))
                ->update(
                array(
                    'photo_one' => $onePath,
                    'alt_text_one' => $request->alt_text_one,
                    'photo_two' => $twoPath,
                    'alt_text_two' => $request->alt_text_two,
                    'photo_three' => $threePath,
                    'alt_text_three' => $request->alt_text_three,
                    'photo_four' => $fourPath,
                    'alt_text_four' => $request->alt_text_four,
                )
        );

        return $component;
    }
    
    public function changePosition($comId, $newPosition){
        $component = $this->model->where(array('id' => $comId))
                ->update(array('position' => $newPosition));
        return $component;
    }

}
