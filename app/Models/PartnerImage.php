<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class PartnerImage extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'partner_category_id',
        'title',
        'description',
        'status',
        'upload_date',
        'banner_img',
        'logo_img',
        'platform',
        'uploaded_by'
    ];

    public function partnerCategory()
    {
        return $this->belongsTo(PartnerCategory::class);
    }
}
