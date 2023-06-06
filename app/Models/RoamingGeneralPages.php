<?php
namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class RoamingGeneralPages extends Model
{
    use LogModelAction;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roaming_general_pages';

    public function searchableFeature()
    {
        return $this->morphOne(SearchableData::class, 'featureable');
    }
}
