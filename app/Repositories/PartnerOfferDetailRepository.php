<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\PartnerOfferDetail;
use App\Models\ProductDetail;


class PartnerOfferDetailRepository extends BaseRepository
{
    public $modelName = PartnerOfferDetail::class;

    public function insertOfferDetail($offerId)
    {
        $this->model->create([
           'partner_offer_id' => $offerId
        ]);
    }

}
