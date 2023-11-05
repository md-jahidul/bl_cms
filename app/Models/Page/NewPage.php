<?php

namespace App\Models\Page;
use Illuminate\Database\Eloquent\Model;

class NewPage extends Model
{
    protected $fillable = ['name','slug','url_slug','schema_markup','page_header_en','page_header_bn','status'];
}
