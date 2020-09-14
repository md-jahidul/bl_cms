<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedbackPage extends Model
{
    public function feedbacks()
    {
        return $this->hasMany(CustomerFeedback::class, 'page_id', 'id');
    }
}
