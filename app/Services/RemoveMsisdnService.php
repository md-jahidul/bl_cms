<?php

namespace App\Services;

class RemoveMsisdnService
{
    /**
     * @param $data
     * @return bool|string
     */
    public function removeMsisdn($data)
    {
        return $this->loadModel($data['feature_list'], $data['msisdn']);
    }

    /**
     * @return array
     */
    public function getTestMsisdnList(): array
    {
        return config('constants.test_msisdn_removal.msisdns');
    }

    /**
     * @return array
     */
    public function getFeatureList(): array
    {
        $features = config('constants.test_msisdn_removal.features');
        $featureList = [];

        foreach ($features as $feature) {
            $featureList[] = $feature['title'] ?? $feature[0]['title'];
        }

        return $featureList;
    }

    /**
     * @param array $features
     * @param $msisdn
     * @return bool|string
     */
    private function loadModel($features = [], $msisdn)
    {
        try {
            $feature_list = config('constants.test_msisdn_removal.features');

            if (!empty($feature_list)) {
                $keys = array_keys($feature_list);
                // Remove the msisdn from the database
                foreach ($features as $item) {
                    if (count(array_column($feature_list[$keys[$item]], 'key'))) {
                        foreach ($feature_list[$keys[$item]] as $k => $feature) {
                            $model_dir = "\App\Models\\" . ucfirst($feature['model']);
                            $model_dir::where($feature['key'], $msisdn)->delete();
                        }
                    } else {
                        $model_dir = "\App\Models\\" . ucfirst($feature_list[$keys[$item]]['model']);
                        $model_dir::where($feature_list[$keys[$item]]['key'], $msisdn)->delete();
                    }
                }
            }

            return [
                'success' => true,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}

