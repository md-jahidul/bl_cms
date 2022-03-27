<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];

    public function page()
    {
        return $this->hasOne(CustomerFeedbackPage::class, 'id', 'page_id');
    }
}
