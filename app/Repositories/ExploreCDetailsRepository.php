<?php

namespace App\Repositories;

use App\Models\OtherDynamicPage;
use Illuminate\Support\Facades\Auth;

// use App\Repositories\BaseRepository;


class ExploreCDetailsRepository extends BaseRepository
{
    protected $modelName = OtherDynamicPage::class;

    public function savePage($data)
    {
        if ($data['page_id'] != "") {
            $page = $this->model->where('id', $data['page_id']);
            unset($data['page_id']);
            $data['updated_by'] = Auth::id();
            return $page->update($data);
        } else {
            unset($data['page_id']);
            $data['created_by'] = Auth::id();
            return $this->model->insert($data);
        }
    }
}
