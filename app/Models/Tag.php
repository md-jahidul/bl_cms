<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use LogModelAction;
    
    protected $fillable = ['title','slug'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'question_id');
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}
