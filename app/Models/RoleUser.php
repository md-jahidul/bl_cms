<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use LogModelAction;
    
    protected $table = 'role_user';
    protected $fillable = ['role_id', 'user_id'];
}
