<?php

namespace App\Repositories;

use App\Models\SupportMessageRating;

/**
 * Class SupportMassageRepository
 * @package App\Repositories
 */
class SupportMassageRepository extends BaseRepository
{
    public $modelName = SupportMessageRating::class;


    /**
     * @return mixed
     */
    public function getSupportMessageList()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }

}
