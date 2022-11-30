<?php


namespace App\Repositories;

use App\Models\FIFA\FifaContent;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FifaContentRepository extends BaseRepository
{
    public $modelName = FifaContent::class;

    public function getFifaContent()
    {
        return $this->model->first();
    }
}
