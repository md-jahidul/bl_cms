<?php

namespace App\Repositories;

use App\Models\MyBlDigitalService;

class MyBlDigitalServiceRepository extends BaseRepository
{

    public $modelName = MyBlDigitalService::class;

    public function destroy($id)
    {
        return MyBlDigitalService::where('id',$id)->delete();
    }
}
