<?php

namespace  App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BaseMsisdnGroup extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'title',
        'status'
    ];

    public function baseMsisdns()
    {
        return $this->hasMany(BaseMsisdn::class, 'group_id', 'id');
    }
}
