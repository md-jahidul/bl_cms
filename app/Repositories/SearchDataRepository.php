<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/03/2020
 */

namespace App\Repositories;

use App\Models\SearchData;

class SearchDataRepository extends BaseRepository {

    public $modelName = SearchData::class;

    public function saveData($productId, $keywordType, $name, $url, $type, $tag, $productCode) {
        $previous = $this->model->where('keyword_id', $productId);
        if ($previous->count() > 0) {
           $save = $previous->update(
                    array(
                        'keyword_type' => $keywordType,
                        'keyword' => $name,
                        'url' => $url,
                        'type' => $type,
                        'tag' => $tag,
                        'product_code' => $productCode,
                    )
            );
        } else {
           $save = $this->model->insert(
                    array(
                        'keyword_id' => $productId,
                        'keyword_type' => $keywordType,
                        'keyword' => $name,
                        'url' => $url,
                        'type' => $type,
                        'tag' => $tag,
                        'product_code' => $productCode,
                    )
            );
        }
        return $save;
    }

    public function updateByCategory($keywordType, $categoryUrl)
    {
        $keywords = $this->model->where('keyword_type', $keywordType)->first();
//        foreach($keywords as $val){
        if ($keywords){
            $kwUrl = $keywords->url;
            $urlArray = explode('/', $kwUrl);
            $newUrl = $urlArray[0] . '/' . $categoryUrl . '/' . $urlArray[2] . '/' . $urlArray[3];
            $this->model->where('id', $keywords->id)->update(['url' => $newUrl]);
        }
//        }
    }

}
