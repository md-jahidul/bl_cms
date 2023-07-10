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

    public function tableSort($request)
    {
        try {
            $positions = $request->position;
            foreach ($positions as $position) {
                $menu_id = $position['id'];
                $new_position = $position['serial'];
                $componentId = $position['component_id'];
                if ($componentId == 0) {
                    $update_menu = $this->findOne($menu_id);
                    $update_menu['display_order'] = $new_position;
                    $update_menu->update();
                }
            }
            Redis::del('non_bl_offer');
            return [
                'status' => "success",
                'massage' => "Order Changed successfully"
            ];
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
            return [
                'status' => "error",
                'massage' => $error
            ];
        }
    }
}
