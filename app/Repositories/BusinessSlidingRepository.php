<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 05/03/2020
 */

namespace App\Repositories;

use App\Models\BusinessSlidingSpeed;

class BusinessSlidingRepository extends BaseRepository {

    public $modelName = BusinessSlidingSpeed::class;

    public function getSlidingSpeed() {
        $response = $this->model->first();
        return $response;
    }

    public function saveSpeed($enSpeed, $newsSpeed) {
        try {

            $speed = $this->model->findOrFail(1);
            $speed->enterprise_speed = $enSpeed;
            $speed->news_speed = $newsSpeed;

           
            $speed->save();

            $response = [
                'success' => 1,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
            ];
            return response()->json($response, 500);
        }
    }



}
