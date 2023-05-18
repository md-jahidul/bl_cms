<?php
namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BusinessInternet extends Model
{
    use LogModelAction;
    protected $table = "business_internet_packages";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $guarded = ['id'];

    public function searchableFeature()
    {
        return $this->morphMany(SearchableData::class, 'featureable');
    }
}
