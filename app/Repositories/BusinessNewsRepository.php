<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessNews;

class BusinessNewsRepository extends BaseRepository {

    public $modelName = BusinessNews::class;

    public function getNews() {
        $data = $this->model->orderBy('sort')->get();
        return $data;
    }

    public function saveNews($filePath, $request) {
        $newsId = $request->news_id;
        if ($newsId != "") {
            $news = $this->model->findOrFail($newsId);
        } else {
            $news = $this->model;
            $news->status = 1;
        }
        if($filePath != ""){
        $news->image_url = $filePath;
        }
        $news->title = $request->title;
        $news->title_bn = $request->title_bn;
        $news->body = $request->body;
        $news->body_bn = $request->body_bn;
        $news->image_name_en = $request->image_name_en;
        $news->image_name_bn = $request->image_name_bn;
        $news->alt_text = $request->alt_text;
        $news->alt_text_bn = $request->alt_text_bn;
        return $news->save();
    }

     public function getSingleNews($newsId) {
        $data = $this->model->findOrFail($newsId);
        return $data;
    }
    
    public function changeNewsSorting($request) {
        try {

            $positions = $request->position;
            foreach ($positions as $position) {
                $newsId = $position[0];
                $new_position = $position[1];
                $update = $this->model->findOrFail($newsId);
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


     public function changeNewsStatus($newsId) {
        try {

            $news = $this->model->findOrFail($newsId);

            $status = $news->status == 1 ? 0 : 1;
            $news->status = $status;
            $news->save();

            $response = [
                'success' => 1,
                'status' => $status,
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
     public function deleteNews($newsId) {
        try {

            $news = $this->model->findOrFail($newsId);
            $photo = $news->image_url;
            $news->delete();

            $response = [
                'success' => 1,
                'photo' => $photo,
            ];
            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'photo' => "",
                'errors' => $e->getMessage()
            ];
            return $response;
        }
    }


}
