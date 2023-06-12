<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class LiveContent extends Model
{
    use LogModelAction;

    protected $fillable = [
        'title_en',
        'title_bn',
        'sub_title_en',
        'sub_title_bn',
        'image_url',
        'web_deep_link',
        'display_order',
        'status'
    ];

    public function visibilityStatus(): bool
    {

        if ($this->status == 1) return true;
        
        return false;
    }
}
