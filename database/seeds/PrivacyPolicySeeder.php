<?php

use App\Models\TermsConditions;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $privacy_policy = file_get_contents(public_path('privacy_policy/privacy_policy.html'));

        \App\Models\PrivacyPolicy::create([
            'platform'          => 'app',
            'privacy_policy'  => $privacy_policy,
        ]);
    }
}
