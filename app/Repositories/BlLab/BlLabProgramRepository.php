<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:34 PM
 */

namespace App\Repositories\BlLab;

use App\Models\BlLab\BlLabProgram;
use App\Repositories\BaseRepository;

class BlLabProgramRepository extends BaseRepository
{
    public $modelName = BlLabProgram::class;

//    public function getTags() {
//        $response = $this->model->get();
//        return $response;
//    }
//    public function getTagById($tagId) {
//        $response = $this->model->findOrFail($tagId);
//        return $response->name_en;
//    }
}
