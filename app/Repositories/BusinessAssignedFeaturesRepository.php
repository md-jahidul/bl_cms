<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessAssignedFeatures;

class BusinessAssignedFeaturesRepository extends BaseRepository {

    public $modelName = BusinessAssignedFeatures::class;

    public function assignFeature($parentId, $parentType, $features) {

        //delete old features
        $this->model->where(array('parent_type' => $parentType, 'parent_id' => $parentId))->delete();

        if (!empty($features)) {
            $data = [];
            foreach ($features as $fId => $v) {
                $data[] = array(
                    'feature_id' => $fId,
                    'parent_type' => $parentType,
                    'parent_id' => $parentId
                );
            }
            if (!empty($data)) {
                $this->model->insert($data);
            }
        }
        return true;
    }

    public function getAssignedFeatures($packageId, $parentType) {
        $data = $this->model->select('feature_id')->where(array('parent_type' => $parentType, 'parent_id' => $packageId))->get();
        $features = [];
        foreach ($data as $f) {
            $features[] = $f->feature_id;
        }
        return $features;
    }

    public function deleteFeature($featureId) {
        try {

            $feature = $this->model->findOrFail($featureId);
            $photo = $feature->icon_url;
            $feature->delete();

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
