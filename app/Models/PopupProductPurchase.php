<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupProductPurchase extends Model
{
    public function details()
    {
        return $this->hasMany(PopupProductPurchaseDetail::class);
    }
}
