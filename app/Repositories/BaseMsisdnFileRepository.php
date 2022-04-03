<?php

namespace App\Repositories;


use App\Models\BaseMsisdnFile;

class BaseMsisdnFileRepository extends BaseRepository
{
    public $modelName = BaseMsisdnFile::class;

    public function deleteFile($fileId)
    {
        return $this->model->whereIn('id', $fileId)->delete();
    }
}
