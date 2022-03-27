<?php
namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AmarOfferDetails extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];
}
