<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseMsisdnGroup extends Model
{
    protected $fillable = [
        'title',
        'status'
    ];

    public function baseMsisdns()
    {
        return $this->hasMany(BaseMsisdn::class, 'group_id', 'id');
    }
}
