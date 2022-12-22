<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedisResetSchedule extends Model
{
    protected $fillable = ['redis_key_to_reset', 'start_at', 'status', 'created_by'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
