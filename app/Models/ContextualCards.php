<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContextualCards extends Model
{
    protected $table = 'contextual_cards';
    protected $fillable = [
        'title',
        'description',
        'first_action_text',
        'second_action_text',
        'first_action',
        'second_action',
        'image_url'
    ];
}
