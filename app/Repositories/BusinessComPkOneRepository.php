<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComPackageOne;

class BusinessComPkOneRepository extends BaseRepository {

    public $modelName = BusinessComPackageOne::class;

    public function saveComponent($position, $head, $ftText, $price, $srvsId) {
        $data = [];
        foreach($head as $k => $v){
           $data[] = array(
               'table_head' => $v,
               'feature_text' => $ftText[$k],
               'price' => $price[$k],
               'position' => $position,
               'service_id' => $srvsId,
           ); 
        }
        
        $this->model->insert($data);
    }

}
