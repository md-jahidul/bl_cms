<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class CorpCaseStudyReportSection extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];
}
