<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SavePrivacyPolicyRequest;
use App\Http\Requests\SaveTermsAndConditionsRequest;
use App\Models\PrefillRechargeAmount;
use App\Models\PrivacyPolicy;
use App\Models\SliderImage;
use App\Models\TermsConditions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PrefillRechargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $amounts = PrefillRechargeAmount::all()->sortBy('sort');
        return view('admin.recharge.prefill-amount.show', compact('amounts'));
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            PrefillRechargeAmount::truncate();

            $data = [];
            foreach ($request->amount as $key => $amount) {
                $data [] = [
                    'amount' => $amount,
                    'sort'   => $key + 1,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];
            }

            PrefillRechargeAmount::insert($data);
            DB::commit();

            return redirect()->back()->with('success', 'Successfully Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePosition(Request $request)
    {
        //return $request;
        foreach ($request->position as $position) {
            $image = PrefillRechargeAmount::FindorFail($position[0]);
            $image->update(['sort' => $position[1]]);
        }
        return "success";
    }
}
