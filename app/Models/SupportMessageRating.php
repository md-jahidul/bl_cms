<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportMessageRating extends Model
{
    protected $guarded = ['id'];
     /**
     * The attributes that are assignable.
     *
     * @var array
     * @author Ahsan Habib <ahabib@bs-23.net>
     */
    protected $fillable = ['msisdn','ticketId','ratings','category_name','complaint_location','status'];

}
