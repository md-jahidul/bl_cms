<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;


use App\Models\Prize;

class PrizeRepository extends BaseRepository
{
    public $modelName = Prize::class;

    public function pluck(array $column){
        $this->modelName = $this->pluck($column);
    }
}