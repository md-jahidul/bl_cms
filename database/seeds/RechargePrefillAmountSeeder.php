<?php

use Illuminate\Database\Seeder;

/**
 * Class RechargePrefillAmountSeeder
 */
class RechargePrefillAmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amounts = [
            39,50,99,100,139,159,250,500
        ];

        $data = [];
        foreach ($amounts as $key=>$amount) {
            $data [] = [
                'amount'     => $amount,
                'sort'       => $key +1,
                'created_at' => now()->toDateTimeString()
            ];
        }

        \App\Models\PrefillRechargeAmount::insert($data);
    }
}
