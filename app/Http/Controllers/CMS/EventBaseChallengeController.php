<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EventBaseBonusChallengeService;
use App\Services\ProductCoreService;

class EventBaseChallengeController extends Controller
{
    private $eventBaseBonusChallengeService;
    private $productCoreService;

    public function __construct(EventBaseBonusChallengeService $eventBaseBonusChallengeService, ProductCoreService $productCoreService)
    {
        $this->middleware('auth');
        $this->eventBaseBonusChallengeService = $eventBaseBonusChallengeService;
        $this->productCoreService = $productCoreService;
    }

    public function index()
    {
        return view('admin.event-base-bonus.challenges.index');
    }

    public function create()
    {
        $products = $this->productCoreService->findAll();

        return view('admin.event-base-bonus.challenges.create', compact('products'));
    }
}
