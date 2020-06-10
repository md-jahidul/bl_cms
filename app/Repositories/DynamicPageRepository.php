<?php

namespace App\Repositories;

use App\Models\OtherDynamicPage;

class DynamicPageRepository extends BaseRepository {

    public $modelName = OtherDynamicPage::class;

    public function savePage($data)
    {
        if ($data['page_id'] != "") {
            $page = $this->model->where('id', $data['page_id']);
            unset($data['page_id']);
            return $page->update($data);
        } else {
            unset($data['page_id']);
            return $this->model->insert($data);
        }
    }
}
