<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/03/2020
 */

namespace App\Repositories;

use App\Models\SearchPopularKeywords;

class PopularSearchRepository extends BaseRepository {

    public $modelName = SearchPopularKeywords::class;

    public function getPopularData() {
        $response = $this->model->get();
        return $response;
    }

    public function saveKeyword($productId, $keyword, $url) {
        $save = $this->model->insert(
                array(
                    'keyword' => $keyword,
                    'url' => $url,
                    'product_id' => $productId,
                )
        );
        return $save;
    }
    
    public function deleteKeyword($kwId){
        return $this->model->findOrFail($kwId)->delete();
    }

}
