<?php

namespace App\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Redis;
use App\Repositories\NonBlOfferRepository;

class NonBlOfferService
{
    use CrudTrait;

    /**
     * @var NonBlOfferRepository
     */
    private $nonBlOfferRepository;

    public function __construct(
        NonBlOfferRepository $nonBlOfferRepository
    ) {
        $this->nonBlOfferRepository = $nonBlOfferRepository;
        $this->setActionRepository($this->nonBlOfferRepository);
    }

    public function findAllOffers()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $nonBlSortableOffers = $this->findAll(null, null, $orderBy);

        return collect($nonBlSortableOffers)->sortBy('display_order')->values()->all();
    }

    public function changeStatus($id)
    {
        $component = $this->findOne($id);
        $component->is_api_call_enable = $component->is_api_call_enable ? 0 : 1;
        $component->save();
        Redis::del('non_bl_offer');
        return response("Successfully status changed");
    }
}
