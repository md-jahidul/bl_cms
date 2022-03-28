<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AboutUsManagement extends Model
{
    use LogModelAction;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'about_us_manangement';

    protected $guarded = ['id'];



}
