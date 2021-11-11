<?php

namespace App\Services;

class RemoveMsisdnService
{
    public function removeMsisdn($msisdn)
    {
        // Remove the msisdn from the database
        // ...
    }


    /**
     * @return array
     */
    public function getTestMsisdnList() : array
    {
        return config('constants.test_msisdn_removal.msisdns');
    }

    /**
     * @return array
     */
    public function getFeatureList() : array
    {
        return config('constants.test_msisdn_removal.features');
    }

    /**
     * @param array $model
     */
    private function loadModel(array $model=[])
    {
        //load model
        dd($model);
    }
}

