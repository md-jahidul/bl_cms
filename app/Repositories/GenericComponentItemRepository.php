<?php

namespace App\Repositories;

use App\Models\GenericComponentItem;

class GenericComponentItemRepository extends BaseRepository
{
    public $modelName = GenericComponentItem::class;

    public function delete($id)
    {
        return $this->modelName::where('id', $id)->delete();
    }
}
