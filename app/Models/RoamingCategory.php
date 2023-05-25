<?php
namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class RoamingCategory extends Model
{
    use LogModelAction;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roaming_cagegories';

    public function searchableFeature()
    {
        return $this->morphOne(SearchableData::class, 'featureable');
    }
}
