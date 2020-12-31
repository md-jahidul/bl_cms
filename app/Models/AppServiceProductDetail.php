<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppServiceProductDetail extends Model
{
    protected $guarded = ['id', 'app_service_product_details_id'];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    /**
     * App service details compoents
     * @return [type] [description]
     */
    public function sectionComponent()
    {
        return $this->hasMany(Component::class, 'section_details_id', 'id')->where('page_type', '=', 'app_services');
    }
}
