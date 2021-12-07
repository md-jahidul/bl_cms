<?php

namespace App\Repositories;

use App\Models\PartnerImage;

class LoyaltyPartnerImageRepository extends BaseRepository
{
    public $modelName = PartnerImage::class;

    public function analytics($data)
    {
        if (count($data) == count(array_filter($data, 'is_null')) || isset($data['page'])) {
            return $this->model->with(['partnerCategory'=>function($query){
                $query->select('id','name_en');
            }])->orderBy('id','desc')->paginate(18);
        } else {
            $result = $this->model->with(['partnerCategory'=>function($query){
                $query->select('id','name_en');
            }]);

            if(isset($data['title'])) {
                $result->where('title', 'like', '%'.$data['title'].'%');
            }

            if(isset($data['category'])) {
                $result->where('partner_category_id', intval($data['category']));
            }

            if(isset($data['status'])) {
                $result->where('status', $data['status']);
            }

            if(isset($data['from_date']) && $data['to_date']) {
                $result->whereBetween('upload_date', [$data['from_date'], $data['to_date']]);
            }

            return $result->orderBy('id','desc')->paginate(18);
        }
    }
}
