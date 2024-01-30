<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class GamificationType extends Model
{
    use LogModelAction;

    protected $table = 'gamification_types';

    protected $fillable = [
        'type_en',
        'type_bn',
        'trivia_gamification_ids',
        'display_order',
        'status'
    ];

    protected $casts = [
        'trivia_gamification_ids' => 'json'
    ];

    public function visibilityStatus(): bool
    {
        if ($this->status == 1) {
            return true;
        }
        return false;
    }
}
