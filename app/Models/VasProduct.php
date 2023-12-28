<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class VasProduct extends Model
{
    use LogModelAction;

    protected $table = 'mybl_vas_products';

    protected $fillable = [
        'subscription_offer_id',
        'partner_id',
        'title_en',
        'title_bn',
        'desc_en',
        'desc_bn',
        'price_en',
        'price_bn',
        'validity_en',
        'validity_bn',
        'image',
        'platform',
        'is_renewable',
        'activation_type',
        'activation_deeplink',
        'deactivation_type',
        'deactivation_deeplink',
        'display_order',
        'status'
    ];

    public function visibilityStatus(): bool
    {
        if ($this->status == 1) return true;
        return false;
    }
}
