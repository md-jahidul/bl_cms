<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComPackageTwo;
use DB;

class BusinessComPkTwoRepository extends BaseRepository {

    public $modelName = BusinessComPackageTwo::class;

    public function saveComponent($position, $title, $name, $data, $days, $price, $srvsId, $oldComponents) {
        $insertData = [];
        foreach ($title as $k => $v) {
            $insertData[] = array(
                'title' => $v,
                'package_name' => $name[$k],
                'data_limit' => $data[$k],
                'package_days' => $days[$k],
                'price' => $price[$k],
                'position' => $position + $oldComponents,
                'service_id' => $srvsId,
            );
        }

        $this->model->insert($insertData);
    }

    public function getComponent($serviceId) {
        $component = $this->model->select(DB::raw('group_concat(id) ids, group_concat(package_name) name, position'))
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

        $titleEn = $request->title_en;
        $titleBn = $request->title_bn;
        $pkEn = $request->package_name_en;
        $pkBn = $request->package_name_bn;
        $dataEn = $request->data_limit_en;
        $dataBn = $request->data_limit_bn;
        $daysEn = $request->package_days_en;
        $daysBn = $request->package_days_bn;
        $priceEn = $request->price_en;
        $priceBn = $request->price_bn;

        $data = [];
        foreach ($comIds as $k => $val) {

            if ($val == NULL) {

                $data[] = array(
                    'title' => $titleEn[$k],
                    'title_bn' => $titleBn[$k],
                    'package_name' => $pkEn[$k],
                    'package_name_bn' => $pkBn[$k],
                    'data_limit' => $dataEn[$k],
                    'data_limit_bn' => $dataBn[$k],
                    'package_days' => $daysEn[$k],
                    'package_days_bn' => $daysBn[$k],
                    'price' => $priceEn[$k],
                    'price_bn' => $priceBn[$k],
                    'position' => $position,
                    'service_id' => $srvsId,
                );
            } else {

                $component = $this->model->where(array('id' => $val))
                        ->update(
                        array(
                            'title' => $titleEn[$k],
                            'title_bn' => $titleBn[$k],
                            'package_name' => $pkEn[$k],
                            'package_name_bn' => $pkBn[$k],
                            'data_limit' => $dataEn[$k],
                            'data_limit_bn' => $dataBn[$k],
                            'package_days' => $daysEn[$k],
                            'package_days_bn' => $daysBn[$k],
                            'price' => $priceEn[$k],
                            'price_bn' => $priceBn[$k],
                        )
                );
            }
        }

        //insert
        if (!empty($data)) {
            $this->model->insert($data);
        }

        //delete component
        if (!empty($deleted)) {
            $this->model->whereIn('id', $deleted)->delete();
        }

        return $component;
    }

    public function changePosition($comIds, $newPosition) {
        $component = $this->model->whereIn('id', $comIds)
                ->update(array('position' => $newPosition));
        return $component;
    }

}
