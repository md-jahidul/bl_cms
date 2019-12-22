<?php

namespace App\Console\Commands;

use App\Models\MyBlProduct;
use Illuminate\Console\Command;

class PackageInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually Insert Plans';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $plans = [
            [
                'product_code' => 'PlayPrepaid',
                'description'  => 'This is Play prepaid description!',
                'media'        => '/plans/banglalink_play.png'
            ],
            [
                'product_code' => 'DeshEkRateDarun',
                'description'  => 'Amazing news for Banglalink subscribers! Banglalink “Desh Ek Rate Darun” is now the default package for all new connections. With this package make any local voice calls with a call rate of 22 paisa/10 seconds only!',
                'media'        => '/plans/ek_desh_ek_rate.jpg'
            ],
            [
                'product_code' => 'InspirePostpaid',
                'description'  => 'Banglalink inspire brings special new features for post-paid subscribers with remarkably low call rates, a whole lot of FNF numbers and other services and facilities!',
                'media'        => '/plans/inspire.jpg'
            ]
        ];

        foreach ($plans as $plan) {
            MyBlProduct::updateOrCreate(
                [
                    'product_code' => $plan['product_code']
                ],
                $plan
            );
        }
    }
}
