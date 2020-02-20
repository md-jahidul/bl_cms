<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComPackageTwo;

class BusinessComPkTwoRepository extends BaseRepository {

    public $modelName = BusinessComPackageTwo::class;

    public function saveComponent($position, $title, $name, $data, $days, $price, $srvsId) {
        $insertData = [];
        foreach($title as $k => $v){
           $insertData[] = array(
               'title' => $v,
               'package_name' => $name[$k],
               'data_limit' => $data[$k],
               'package_days' => $days[$k],
               'price' => $price[$k],
               'position' => $position,
               'service_id' => $srvsId,
           ); 
        }
        
        $this->model->insert($insertData);
    }

}
