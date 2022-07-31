<?php

namespace App\Repositories;


use App\Models\MyblOrangeClubRedeemDetail;

class MyblOrangeClubRedeemDetailRepository extends BaseRepository
{
    public $modelName = MyblOrangeClubRedeemDetail::class;

    public function first() {

        return $this->model::first();
    }
}
