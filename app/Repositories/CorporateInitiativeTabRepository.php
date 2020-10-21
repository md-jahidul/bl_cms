<?php

namespace App\Repositories;

use App\Models\CorpInitiativeTab;

class CorporateInitiativeTabRepository extends BaseRepository
{
    public $modelName = CorpInitiativeTab::class;

    public function getInitiativeTab($id = null)
    {
        $data = $this->model
            ->select('id', 'title_en as name');
        if ($id) {
            $data->where('id', $id);
            return $data->first();
        }
        return $data->get();
    }
}
