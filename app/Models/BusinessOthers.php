<?php
namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BusinessOthers extends Model
{
    use LogModelAction;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_other_services';

    public function searchableFeature()
    {
        return $this->morphMany(SearchableData::class, 'featureable');
    }
}
