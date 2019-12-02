<?php

namespace App\Models;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;

class SliderComponentType extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }
}
