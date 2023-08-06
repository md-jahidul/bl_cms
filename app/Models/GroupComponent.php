<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class GroupComponent extends Model
{
    use LogModelAction;

    protected $table = 'my_bl_group_components';

    protected $guarded = [];
}
