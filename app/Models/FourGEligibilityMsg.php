<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class FourGEligibilityMsg extends Model
{
    use LogModelAction;
    protected $table = 'eligibility_messages';
    protected $casts = ['other_attributes' => 'array'];
    protected $fillable = ['key', 'other_attributes'];
}
