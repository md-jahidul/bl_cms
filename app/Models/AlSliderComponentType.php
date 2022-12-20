<?php

namespace App\Models;

use App\Models\AlSlider;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlSliderComponentType extends Model
{
    use LogModelAction;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function sliders()
    {
        return $this->hasMany(AlSlider::class);
    }

}
