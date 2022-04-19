<?php

namespace App\Services;

use App\Models\OwnRechargeWinningCapping;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class OwnRechargeWinningCappintService
{
    public function create($data){
        // dd($data);
        return OwnRechargeWinningCapping::create($data);
    }

    public function find($own_recharge_id){
        
        return OwnRechargeWinningCapping::where('own_recharge_id', $own_recharge_id)->first();
    }

    public function update($winning_capping_id, $data){

        return OwnRechargeWinningCapping::where('id', $winning_capping_id)->update($data);
    }
}
