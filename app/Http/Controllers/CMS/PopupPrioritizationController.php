<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\PopupPrioritization;
use Illuminate\Http\Request;

class PopupPrioritizationController extends Controller
{

    public function index()
    {
        $sequenceData = PopupPrioritization::first();
        if ($sequenceData){
            $sequence = explode(',', $sequenceData->campaign_sequence);
            $count = count($sequence);
            $campaign = '';
            $banner = '';

            for ($i = 1; $i <= $count; $i++) {
                if ($sequence[$i-1] == 'nc') {
                    if ($campaign == '') {
                        $campaign = $campaign . $i;
                    } else {
                        $campaign = $campaign . ',' .  $i;
                    }
                } else {

                    if ($banner == '') {
                        $banner = $banner . $i;
                    } else {
                        $banner = $banner . ',' . $i ;
                    }
                }
            }
        } else {
            $campaign = '';
            $banner = '';
        }


        return view('admin.popup-prioritization.index', compact('campaign', 'banner'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $campaign = explode(',', $data['campaign']);
        $banner = explode(',', $data['banner']);
        $total = count($campaign) + count($banner);
        $campaignIndex = 0;
        $bannerIndex = 0;
        $sequence = '';

        for ($i = 0; $i < $total; $i++) {
            if ($i == 0) {
                if ($bannerIndex == count($banner)) {
                    $sequence = 'nc';
                    ++$campaignIndex;
                }
                elseif ($campaignIndex == count($campaign)) {
                    $sequence = 'b';
                    ++$bannerIndex;
                }
                elseif ($campaign[$campaignIndex] < $banner[$bannerIndex]){
                    $sequence = 'nc';
                    ++$campaignIndex;
                } else{
                    $sequence = 'b';
                    ++$bannerIndex;
                }
            } else {
                if ($bannerIndex == count($banner)) {
                    $sequence = $sequence . ',nc';
                    ++$campaignIndex;
                }
                elseif ($campaignIndex == count($campaign)) {
                    $sequence = $sequence . ',b';
                    ++$bannerIndex;
                }
                elseif ($campaign[$campaignIndex] < $banner[$bannerIndex]){
                    $sequence = $sequence . ',nc';
                    ++$campaignIndex;
                } else{
                    $sequence = $sequence . ',b';
                    ++$bannerIndex;
                }
            }
        }

        $sequenceData = PopupPrioritization::first();

        if ($sequenceData) {
            $sequenceData->update(['campaign_sequence' => $sequence]);
        } else {
            PopupPrioritization::create(['campaign_sequence' => $sequence]);
        }
        session()->flash('message', 'Sequence Update Successfully.');
        return redirect(route('popup-sequence.index'));
    }


    public function edit(PopupPrioritization $popupPrioritization)
    {
        //
    }


    public function update(Request $request, PopupPrioritization $popupPrioritization)
    {
        //
    }

}
