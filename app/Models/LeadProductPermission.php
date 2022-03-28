<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class LeadProductPermission extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];

    public function leadRequest(){
        return $this->hasOne(LeadRequest::class, 'lead_category_id', 'lead_category_id');
    }
}
