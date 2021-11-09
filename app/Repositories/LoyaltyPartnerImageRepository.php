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
            return $this->model->orWhere('title', $data['title'])->orWhere('status', $data['status'] ?? 0)->orWhere('partner_category_id', intval($data['category']))
                  ->orWhereBetween('upload_date', [$data['from_date'], $data['to_date']])->with(['partnerCategory'=>function($query){
                    $query->select('id','name_en');
                }])->orderBy('id','desc')->paginate(18);
        }
    }
}
