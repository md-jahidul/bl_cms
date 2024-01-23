<?php

namespace App\Repositories;

use App\Models\GenericRailItem;

class GenericRailItemRepository extends BaseRepository
{

    public $modelName = GenericRailItem::class;

    public function getItems($railId)
    {
        return $this->model->where('generic_rail_id', $railId)->orderBy('display_order','ASC')->get();
    }

    public function delete($itemId)
    {
        return $this->model->where('id', $itemId)->delete();
    }
}
