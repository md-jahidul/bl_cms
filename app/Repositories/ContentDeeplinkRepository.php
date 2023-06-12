<?php

namespace App\Repositories;
use App\Models\ContentDeeplink;

class ContentDeeplinkRepository extends BaseRepository
{

    public $modelName = ContentDeeplink::class;

    public function getAllData()
    {
        return $this->model->orderBy('id', 'desc')
            ->get();
    }
    public function destroy($id)
    {
        return ContentDeeplink::where('id',$id)->delete();
    }

    public function store($data)
    {
        $data['slug'] = $data['category_name'];

        if (isset($data['detail_id'])) {

            if (substr($data['detail_id'], 0, 1) === '?') {
                $data['slug'] .= $data['detail_id'];
            } else {
                $data['slug'] .= ('/' . $data['detail_id']);
            }
        }

        return ContentDeeplink::create($data);
    }
}
