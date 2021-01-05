<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PopupProductPurchase extends Model
{
    public function details()
    {
        return $this->hasMany(PopupProductPurchaseDetail::class);
    }

    public function detailsBetween($from = null, $to =null)
    {
        $from = is_null($from) ? Carbon::now()->toDateString() : Carbon::parse($from)->toDateString();
        $to = is_null($from) ? Carbon::now()->toDateString() : Carbon::parse($to)->toDateString();

        return $this->details->whereBetween('created_at', [$from, $to]);
    }
}
