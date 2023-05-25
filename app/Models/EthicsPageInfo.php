<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EthicsPageInfo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ethics_page_info';

    public function searchableFeature()
    {
        return $this->morphOne(SearchableData::class, 'featureable');
    }
}
