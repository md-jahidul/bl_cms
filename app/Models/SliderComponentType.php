<?php

namespace App\Models;

use App\Models\Slider;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class SliderComponentType extends Model
{
    use LogModelAction;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }
}
