<?php

namespace App\Http\Controllers\CMS;

use App\Models\TermsConditions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsAndConditionsController extends Controller
{
    public function  show()
    {
        $terms_conditions = TermsConditions::where('platform','app')->first();

        return view('admin.terms-conditions.show',compact('terms_conditions'));
    }

    public function store(Request $request)
    {
       TermsConditions::updateOrCreate([
           'platform' => 'app'
       ],[
           'terms_conditions' => $request->terms_conditions
       ]);

        return redirect()->back()->with('message', 'Terms and Conditions are Saved');
    }
}
