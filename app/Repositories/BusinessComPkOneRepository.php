<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComPackageOne;
use DB;

class BusinessComPkOneRepository extends BaseRepository {

    public $modelName = BusinessComPackageOne::class;

    public function saveComponent($position, $head, $ftText, $price, $srvsId, $oldComponents) {
        $data = [];
        foreach ($head as $k => $v) {
            $data[] = array(
                'table_head' => $v,
                'feature_text' => $ftText[$k],
                'price' => $price[$k],
                'position' => $position + $oldComponents,
                'service_id' => $srvsId,
            );
        }

        $this->model->insert($data);
    }

    public function getComponent($serviceId) {
        $component = $this->model->select(DB::raw('group_concat(id) ids, group_concat(table_head) heads, position'))
                        ->where('service_id', $serviceId)->groupBy('position')->get();
        return $component;
    }

    public function deleteComponent($serviceId, $position) {
        $component = $this->model->where(array('service_id' => $serviceId, 'position' => $position))->delete();
        return $component;
    }

    public function singleComponent($serviceId, $position) {
        $component = $this->model->where(array('service_id' => $serviceId, 'position' => $position))->get();
        return $component;
    }

    public function updateComponent($request) {

        $comIds = $request->com_id;
        $deleted = $request->deleted;
        $srvsId = $request->service_id;
        $position = $request->position;

        $headEn = $request->table_head_en;
        $headBn = $request->table_head_bn;
        $ftEn = $request->feature_text_en;
        $ftBn = $request->feature_text_bn;
        $priceEn = $request->price_en;
        $priceBn = $request->price_bn;

        foreach ($comIds as $k => $val) {

            if ($val == "") {

                $data[] = array(
                    'table_head' => $headEn[$k],
                    'table_head_bn' => $headBn[$k],
                    'feature_text' => $ftEn[$k],
                    'feature_text_bn' => $ftBn[$k],
                    'price' => $priceEn[$k],
                    'price_bn' => $priceBn[$k],
                    'position' => $position,
                    'service_id' => $srvsId,
                );
                $this->model->insert($data);
            } else {

                $component = $this->model->where(array('id' => $val))
                        ->update(
                        array(
                            'table_head' => $headEn[$k],
                            'table_head_bn' => $headBn[$k],
                            'feature_text' => $ftEn[$k],
                            'feature_text_bn' => $ftBn[$k],
                            'price' => $priceEn[$k],
                            'price_bn' => $priceBn[$k],
                        )
                );
            }
        }

        return $component;
    }

    public function changePosition($comIds, $newPosition) {
        $component = $this->model->whereIn('id', $comIds)
                ->update(array('position' => $newPosition));
        return $component;
    }

}
