<?php


namespace App\Repositories;

use App\Models\GenericShortcut;

class GenericShortcutRepository extends BaseRepository
{
    public $modelName = GenericShortcut::class;

    public function getMaxSortOrder($data)
    {
        return $this->model->where('generic_shortcut_master_id', $data['generic_shortcut_master_id'])->max('sort_order');
    }
}
