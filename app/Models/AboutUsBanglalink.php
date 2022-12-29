<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AboutUsBanglalink extends Model
{
    use LogModelAction;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'about_us_banglalink';

    protected $casts = [
        'other_attributes' => 'array'
    ];

    protected $guarded = ['id'];

}
