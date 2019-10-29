<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SavePrivacyPolicyRequest;
use App\Http\Requests\SaveTermsAndConditionsRequest;
use App\Models\PrivacyPolicy;
use App\Models\TermsConditions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $privacy_policy = PrivacyPolicy::where('platform', 'app')->first();

        return view('admin.privacy-policy.show', compact('privacy_policy'));
    }

    public function store(SavePrivacyPolicyRequest $request)
    {
        PrivacyPolicy::updateOrCreate([
           'platform' => 'app'
        ], [
           'privacy_policy' => $request->privacy_policy
        ]);

        return redirect()->back()->with('success', 'Privacy Policy are Saved');
    }
}
