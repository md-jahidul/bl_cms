<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComVideo;

class BusinessComVideoRepository extends BaseRepository {

    public $modelName = BusinessComVideo::class;

    public function saveComponent($position, $vData, $serviceId, $oldComponents) {

        $data['videoNameEn'] = $vData['videoNameEn'];
        $data['videoNameBn'] = $vData['videoNameBn'];

        $data['videoTitleEn'] = $vData['videoTitleEn'];
        $data['videoTitleBn'] = $vData['videoTitleBn'];

        $data['videoEmbed'] = $vData['videoEmbed'];

        $data['videoDesEn'] = $vData['videoDesEn'];
        $data['videoDesBn'] = $vData['videoDesBn'];
        

        $this->model->insert(
                array(
                    "name" => $data['videoNameEn'],
                    "name_bn" => $data['videoNameBn'],
                    "title" => $data['videoTitleEn'],
                    "title_bn" => $data['videoTitleBn'],
                    "embed_code" => $data['videoEmbed'],
                    "description" => $data['videoDesEn'],
                    "description_bn" => $data['videoDesBn'],
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
                    'name' => $request->name_en,
                    'name_bn' => $request->name_bn,
                    'title' => $request->title_en,
                    'title_bn' => $request->title_bn,
                    'description' => $request->description_en,
                    'description_bn' => $request->description_bn,
                    'embed_code' => $request->embed_code,
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
