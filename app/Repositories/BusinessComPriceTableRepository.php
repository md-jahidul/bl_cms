<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 19/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessComPriceTable;

class BusinessComPriceTableRepository extends BaseRepository {

    public $modelName = BusinessComPriceTable::class;

    public function saveComponent($position, $title, $head, $colOne, $colTwo, $colThree, $srvsId) {
        $data = [];

        $headJson = json_encode($head);

        $bodyOne = $colOne;
        $bodyTwo = $colTwo;
        $bodyThree = $colThree;
        $body = array(
            0 => $bodyOne, 1 => $bodyTwo, 2 => $bodyThree
        );
        $bodyJson = json_encode($body);

        $data[] = array(
            'title' => $title,
            'table_head' => $headJson,
            'table_body' => $bodyJson,
            'position' => $position,
            'service_id' => $srvsId,
        );

        $this->model->insert($data);
    }

}
