<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class DynamicUrlRedirection extends Model
{
    use LogModelAction;
    
    protected $fillable = ['title', 'redirection_for', 'identifier', 'from_url', 'to_url', 'status', 'created_by'];
}
