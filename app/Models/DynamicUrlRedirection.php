<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicUrlRedirection extends Model
{
    protected $fillable = ['title', 'redirection_for', 'identifier', 'from_url', 'to_url', 'status', 'created_by'];
}
