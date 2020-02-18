<?php

namespace App\Http\Controllers\AssetLite    ;

use App\Http\Controllers\Controller;
use App\Services\Banglalink\LeadRequestService;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class LeadManagementController extends Controller
{
    /**
     * @var $leadRequestService
     */
    protected $leadRequestService;


    /**
     * LeadManagementController constructor.
     * @param LeadRequestService $leadRequestService
     */
    public function __construct(LeadRequestService $leadRequestService)
    {
        $this->leadRequestService = $leadRequestService;
    }

    /**
     * @return Factory|View
     */
    public function leadRequestedList()
    {
        $allRequest = $this->leadRequestService->leadRequestedData();
        return view('admin.lead-management.index', compact('allRequest'));
    }

}
