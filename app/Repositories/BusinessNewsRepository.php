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
        $data = $this->model->orderBy('id', 'DESC')->get();
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
        $news->body = $request->body;
        return $news->save();
    }
    
     public function getSingleNews($newsId) {
        $data = $this->model->findOrFail($newsId);
        return $data;
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
