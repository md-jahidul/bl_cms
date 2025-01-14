<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'partner_category_id',
        'company_name_en',
        'company_name_bn',
        'company_logo',
        'company_address',
        'company_website',
        'contact_person_name',
        'contact_person_email',
        'contact_person_mobile',
        'google_play_link',
        'apple_app_store_link',
        'other_attributes',
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function partnerCategory()
    {
        return $this->belongsTo(PartnerCategory::class);
    }

    public function partnerOffers()
    {
        return $this->hasMany(PartnerOffer::class);
    }
}
