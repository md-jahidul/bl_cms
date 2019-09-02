<?php


namespace App\Repositories;
use App\Models\FooterMenu;

class FooterMenuRepository extends BaseRepository
{
    public $modelName = FooterMenu::class;

    public function parentFooter()
    {
        return $this->model->where('parent_id', 0)->get();
    }
}
