<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\RemoveMsisdnService;

class RemoveMsisdnController extends Controller
{
    /**
     * @var $removeMsisdnService
     */
    private $removeMsisdnService;

    /**
     * @param RemoveMsisdnService $removeMsisdnService
     */
    public function __construct(RemoveMsisdnService $removeMsisdnService)
    {
        $this->removeMsisdnService = $removeMsisdnService;
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function index(){
        $testMsisdnList = $this->removeMsisdnService->getTestMsisdnList();
        $featureList = json_encode($this->removeMsisdnService->getFeatureList(), JSON_UNESCAPED_SLASHES);

        return view('admin.remove-msisdn.index', compact('testMsisdnList', 'featureList'));
    }
}
