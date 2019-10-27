<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
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
