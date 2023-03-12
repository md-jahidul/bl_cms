<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GenericShortcutMaster extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'component_for',
        'status'
    ];

    public function shortcuts(): HasMany
    {
        return $this->hasMany(GenericShortcut::class, 'generic_shortcut_master_id', 'id');
    }
}
