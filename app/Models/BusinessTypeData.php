<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessTypeData extends Model
{
    protected $table = 'business_type_datas';

    protected $guarded = ['id'];

    protected $casts = [
        'other_attributes' => 'array',
    ];

    public function businessType(): BelongsTo
    {
        return $this->belongsTo(BusinessType::class);
    }
    // protected $fillable = [
    //     'title_en',
    //     'title_bn',
    //     'status',
    //     'slag'
    // ];
}
