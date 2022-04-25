<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedbackPage extends Model
{
    use LogModelAction;
    
    public function feedbacks()
    {
        return $this->hasMany(CustomerFeedback::class, 'page_id', 'id');
    }
}
