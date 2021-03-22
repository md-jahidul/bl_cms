<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SaveTermsAndConditionsRequest;
use App\Models\TermsConditions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TermsAndConditionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($featureName = 'general')
    {
        $terms_conditions = TermsConditions::where('platform', 'app')->where('feature_name', $featureName)->first();

        return view('admin.terms-conditions.show', compact('terms_conditions', 'featureName'));
    }

    public function store(SaveTermsAndConditionsRequest $request)
    {
        TermsConditions::updateOrCreate(
            ['platform' => 'app', 'feature_name' => $request->feature_name],
            [
                'terms_conditions' => $request->terms_conditions,
                'feature_name' => $request->feature_name,
                'terms_conditions_bn' => $request->terms_conditions_bn
            ]
        );
        Session::flash('message', 'Terms and conditions update successfully !!');
        return redirect()->back();
    }
}
