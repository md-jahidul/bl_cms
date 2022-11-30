<?php

namespace App\Http\Controllers\CMS\NewCampaignModality;

use App\Http\Controllers\Controller;
use App\Models\NewCampaignModality\MyBlCampaignWinner;
use App\Repositories\NewCampaignModality\MyBlCampaignWinnerRepository;
use Illuminate\Http\Request;

class MyBlCampaignWinnerController extends Controller
{
    private $myblCampaignWinnerRepository;

    public function __construct(MyBlCampaignWinnerRepository $myblCampaignWinnerRepository)
    {
        $this->myblCampaignWinnerRepository = $myblCampaignWinnerRepository;
    }

    public function index()
    {
        $winners = $this->myblCampaignWinnerRepository->findAll();

        return view('admin.mybl-campaign.new-campaign-modality.winner.index', compact('winners'));
    }
}
