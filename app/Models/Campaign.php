<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use LogModelAction;
    
    protected $fillable = ['title', 'motivational_quote', 'start_date', 'end_date', 'is_enable'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function prizes()
    {
        return $this->hasMany(Prize::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
