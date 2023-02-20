<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class PartnerOfferDetail extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'partner_offer_id',
        'page_header',
        'page_header_bn',
        'schema_markup',
        'url_slug',
        'url_slug_bn',
        'details_en',
        'details_bn',
        'offer_details_en',
        'offer_details_bn',
        'eligible_customer_en',
        'eligible_customer_bn',
        'avail_en',
        'avail_bn',
        'banner_image_url',
        'banner_mobile_view',
        'banner_alt_text',
        'banner_alt_text_bn',
        'banner_name',
        'banner_name_bn',
        'created_by',
        'updated_by'
    ];
}

