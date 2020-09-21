<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    protected $guarded = ['id'];

    public function page()
    {
        return $this->hasOne(CustomerFeedbackPage::class, 'id', 'page_id');
    }
}
