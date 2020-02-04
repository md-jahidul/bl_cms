<?php

namespace App\Repositories;

use App\Models\AboutUsBanglalink;

class AboutUsRepository extends BaseRepository
{

    public $modelName = AboutUsBanglalink::class;

    /**
     *
     * @return mixed
     */
    public function getAboutUsInfo()
    {
        return $this->model->get();
    }
}
