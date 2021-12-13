<?php

namespace App\Repositories;

use App\Models\CsSelfcareReferrer;

class CsSelfcareReferrerRepository extends BaseRepository
{
    protected $modelName = CsSelfcareReferrer::class;

    public function checkRecord($msisdn)
    {
        $msisdn = "0" . $msisdn;
        return $this->model->select('id')->where('referrer', $msisdn)->first();
    }
}
