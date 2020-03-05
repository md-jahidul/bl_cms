<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 19/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComPriceTable;

class BusinessComPriceTableRepository extends BaseRepository {

    public $modelName = BusinessComPriceTable::class;

    public function saveComponent($position, $tableData, $srvsId, $oldComponents) {


        $data = [];

        $titleEn = $tableData['ptTitleEn'];
        $titleBn = $tableData['ptTitleBn'];
        
        $headJsonEn = json_encode($tableData['ptHeadEn']);
        $headJsonBn = json_encode($tableData['ptHeadBn']);

        $bodyEn = array(
            0 => $tableData['ptColOneEn'], 1 => $tableData['ptColTwoEn'], 2 => $tableData['ptColThreeEn']
        );
        $bodyJsonEn = json_encode($bodyEn);
        
        $bodyBn = array(
            0 => $tableData['ptColOneBn'], 1 => $tableData['ptColTwoBn'], 2 => $tableData['ptColThreeBn']
        );
        $bodyJsonBn = json_encode($bodyBn);
        

        $data[] = array(
            'title' => $titleEn,
            'title_bn' => $titleBn,
            'table_head' => $headJsonEn,
            'table_head_bn' => $headJsonBn,
            'table_body' => $bodyJsonEn,
            'table_body_bn' => $bodyJsonBn,
            'position' => $position + $oldComponents,
            'service_id' => $srvsId,
        );

        $this->model->insert($data);
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

        $headEnArray = array(
            0 => $request->head_one_en,
            1 => $request->head_two_en,
            2 => $request->head_three_en,
        );
        $headEn = json_encode($headEnArray);

        $headBnArray = array(
            0 => $request->head_one_bn,
            1 => $request->head_two_bn,
            2 => $request->head_three_bn,
        );
        $headBn = json_encode($headBnArray);

        $bodyEnArray = array(
            0 => $request->column_one_en,
            1 => $request->column_two_en,
            2 => $request->column_three_en,
        );
        $bodyEn = json_encode($bodyEnArray);

        $bodyBnArray = array(
            0 => $request->column_one_bn,
            1 => $request->column_two_bn,
            2 => $request->column_three_bn,
        );
        $bodyBn = json_encode($bodyBnArray);



        $component = $this->model->where(array('id' => $comId))
                ->update(
                array(
                    'title' => $request->title_en,
                    'title_bn' => $request->title_bn,
                    'table_head' => $headEn,
                    'table_head_bn' => $headBn,
                    'table_body' => $bodyEn,
                    'table_body_bn' => $bodyBn,
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
