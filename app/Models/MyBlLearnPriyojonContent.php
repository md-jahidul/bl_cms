<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MyBlLearnPriyojonContent
 * @package App\Models
 */
class MyBlLearnPriyojonContent extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'id', 'platform', 'contents'
    ];
}
