<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/03/2020
 */

namespace App\Repositories;

use App\Models\SearchSetting;

class SearchSettingRepository extends BaseRepository {

    public $modelName = SearchSetting::class;

    public function getSettingData() {
        $response = $this->model->get();
        return $response;
    }

    public function saveLimit($settingId, $limit) {
        try {

            $setting = $this->model->findOrFail($settingId);
            $setting->limit = $limit;
            $setting->save();

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
