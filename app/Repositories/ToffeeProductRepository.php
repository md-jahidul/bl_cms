<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\DigitalService;
use App\Models\MyBlDigitalService;
use App\Models\ToffeeProduct;

class ToffeeProductRepository extends BaseRepository
{
    public $modelName = ToffeeProduct::class;

    public function destroy($id)
    {
        return ToffeeProduct::where('id',$id)->delete();
    }
}
