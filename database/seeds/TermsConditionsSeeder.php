<?php

use App\Models\TermsConditions;
use Illuminate\Database\Seeder;

class TermsConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms_conditions = file_get_contents(public_path('terms_conditions/terms_conditions.html'));

        TermsConditions::create([
            'platform'          => 'app',
            'terms_conditions'  => $terms_conditions,
        ]);
    }
}
