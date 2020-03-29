<?php

namespace App\Repositories;

use App\Models\Shortcut;

class ShortCutRepository extends BaseRepository
{
    public $modelName = Shortcut::class;


    /**
     * @return mixed
     */
    public function getShortcutList()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }

    /**
     * @param $request
     * @return string
     */
    public function sortShortcutsList($request)
    {
        $positions = $request->position;

        return $this->sortData($positions);
    }

}
