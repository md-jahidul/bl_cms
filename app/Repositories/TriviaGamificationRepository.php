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

    public function otherGamification($gamification)
    {
        return $this->model->where('type', $gamification->type)
                            ->where('content_for', $gamification->content_for)
                            ->where('id','!=' ,$gamification->id)
                            ->where('status', 1)
                            ->get();
    }

    public function updateOtherGamificationContentFor($otherGamifications)
    {
        $ids = [];

        foreach ($otherGamifications as $otherGamification) {
            $ids[] = $otherGamification->id;
        }

        return $this->model->where('status', 1)
                            ->whereIn('id', $ids)
                            ->update(['content_for' => 'ALL']);
    }


}
