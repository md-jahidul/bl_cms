<?php
namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    use LogModelAction;
    protected $guarded = ['id'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_product_categories';

    public function searchableFeature()
    {
        return $this->morphMany(SearchableData::class, 'featureable');
    }
}
