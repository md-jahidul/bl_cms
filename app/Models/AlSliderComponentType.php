<?php

namespace App\Models;

use App\Models\AlSlider;
use Illuminate\Database\Eloquent\Model;

class AlSliderComponentType extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function sliders()
    {
        return $this->hasMany(AlSlider::class);
    }
}
