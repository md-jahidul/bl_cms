<?php

namespace App\Http\Controllers\AssetLite\BlLab;

use App\Http\Controllers\Controller;
use App\Services\BlLab\BlLabApplicationService;
use App\Services\BlLab\BlLabEducationService;
use App\Services\BlLab\BlLabProgramService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;

class BlLabApplicationController extends Controller
{
    /**
     * @var BlLabApplicationService
     */
    private $labApplicationService;
    /**
     * @var BlLabProgramService
     */
    private $blLabProgramService;

    /**
     * BlLabApplicationController constructor.
     * @param BlLabApplicationService $labApplicationService
     */
    public function __construct(
        BlLabApplicationService $labApplicationService,
        BlLabProgramService $blLabProgramService
    ) {
        $this->labApplicationService = $labApplicationService;
        $this->blLabProgramService = $blLabProgramService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applicationList(Request $request)
    {
        if ($request->ajax()){
            return $this->labApplicationService->getApplications($request);
        }
        $programs = $this->blLabProgramService->findAll();
        return view('admin.bl-lab.applications.index', compact('programs'));
    }
}
