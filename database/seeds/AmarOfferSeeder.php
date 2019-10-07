<?php

use Illuminate\Database\Seeder;

class AmarOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('amar_offers')->insert([
            'title'=>'30MB @ 1.5 TK / 4 Days (including all taxes)',
            'internet'=>'0',
            'minutes'=>'0',
            'sms'=>'0',
            'validity'=>'30',
            'price'=>'1.5',
            'offer_code'=>'*5000*414#',
            'tag'=>'BL',
            'points'=>'10'
        ]);
        DB::table('amar_offers')->insert([
            'title'=>'Browse more with Banglalink internet!',
            'internet'=>'0',
            'minutes'=>'0',
            'sms'=>'0',
            'validity'=>'30',
            'price'=>'100',
            'offer_code'=>'*5000*108#',
            'tag'=>'0',
            'points'=>'10'
           
        ]);
        DB::table('amar_offers')->insert([
            'title'=>'Tk. 297 Bundle',
            'internet'=>'0',
            'minutes'=>'0',
            'sms'=>'0',
            'validity'=>'30',
            'price'=>'297',
            'offer_code'=>'*166*297#',
            'tag'=>'0',
            'points'=>'10'
           
        ]);
       
    }
}
