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
        $response = $this->model->orderBy('sort')->get();
        return $response;
    }

//    public function saveKeyword($productId, $keyword, $url) {
//        $save = $this->model->insert(
//                array(
//                    'keyword' => $keyword,
//                    'url' => $url,
//                    'product_id' => $productId,
//                )
//        );
//        return $save;
//    }

    public function getKeywordById($kwId){
        $response = $this->model->findOrFail($kwId);
        return $response;
    }

        public function deleteKeyword($kwId){
        return $this->model->findOrFail($kwId)->delete();
    }

    public function updateKeyword($keywordId, $keyword){

            $popular = $this->model->findOrFail($keywordId);

            $popular->keyword = $keyword;
            return $popular->save();


    }
    public function changeStatus($kwId) {
        try {

            $popular = $this->model->findOrFail($kwId);

            $status = $popular->status == 1 ? 0 : 1;
            $popular->status = $status;
            $popular->save();

            $response = [
                'success' => 1,
                'show_status' => $status,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function changeKeywordSorting($request) {
        try {

            $positions = $request->position;
            foreach ($positions as $position) {
                $kwId = $position[0];
                $new_position = $position[1];
                $update = $this->model->findOrFail($kwId);
                $update['sort'] = $new_position;
                $update->update();
            }

            $response = [
                'success' => 1,
                'message' => 'Success'
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

}
