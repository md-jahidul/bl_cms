<?php
namespace App\Repositories;

use App\Models\ToffeeSubscriptionType;

class ToffeeSubscriptionTypeRepository extends BaseRepository
{
    public $modelName = ToffeeSubscriptionType::class;

    public function toffeeSubscriptionType()
    {
        return $this->model::orderBy('created_at', 'desc')->first();
    }

}
