<?php

namespace App;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class ToffeeSubscriptionType extends Model
{
    use LogModelAction;

    protected $fillable = [
        'subscription_type',
        'content_ids',
        'status'
    ];

    public function visibilityStatus(): bool
    {

        if ($this->status == 1) return true;
        
        return false;
    }
}
