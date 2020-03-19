<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/03/2020
 */

namespace App\Repositories;

use App\Models\SearchData;

class SearchDataRepository extends BaseRepository {

    public $modelName = SearchData::class;

    public function saveData($productId, $name, $url, $type, $tag) {
        $previous = $this->model->where('keyword_id', $productId);
        if ($previous->count() > 0) {
           $save = $previous->update(
                    array(
                        'keyword' => $name,
                        'url' => $url,
                        'type' => $type,
                        'tag' => $tag,
                    )
            );
        } else {
           $save = $this->model->insert(
                    array(
                        'keyword_id' => $productId,
                        'keyword_type' => 'offer-product',
                        'keyword' => $name,
                        'url' => $url,
                        'type' => $type,
                        'tag' => $tag,
                    )
            );
        }
        return $save;
    }

}
