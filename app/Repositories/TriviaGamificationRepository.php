<?php

namespace App\Repositories;

use App\Models\TriviaGamification;
class TriviaGamificationRepository extends BaseRepository
{
    public $modelName = TriviaGamification::class;

    public function saveTriviaInfo($data)
    {
        return $this->model->updateOrCreate(['id' => $data['id']], $data);
    }
}
