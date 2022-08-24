<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\CorpIntComponentMultiItem;

class CorpIntComponentMultiItemRepository extends BaseRepository
{
    public $modelName = CorpIntComponentMultiItem::class;

    public function findDetail($key)
    {
        return $this->model->where('slug', $key)->first();
    }

    public function deleteAllById($id)
    {
        return $this->model
            ->whereNull('batch_com_id')
            ->whereIn('corp_int_tab_com_id', [$id])
            ->delete();
    }
}
