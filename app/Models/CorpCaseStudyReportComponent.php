<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorpCaseStudyReportComponent extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'other_attributes' => 'array',
        'banner' => 'array'
    ];
}
