<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class VasProduct extends Model
{
    use LogModelAction;

    protected $table = 'mybl_vas_products';

    protected $fillable = [
        'partner_id',
        'cp_id',
        'title_en',
        'title_bn',
        'desc_en',
        'desc_bn',
        'price',
        'validity_en',
        'validity_bn',
        'image',
        'platform',
        'is_renewal',
        'activation_type',
        'deactivation_type',
        'status'
    ];

    public function visibilityStatus(): bool
    {
        if ($this->status == 1) return true;
        return false;
    }
}
