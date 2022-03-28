<?php
namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BusinessHomeBanner extends Model
{
    use LogModelAction;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_home_banner';
}