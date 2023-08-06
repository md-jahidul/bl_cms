<?php

namespace App\Http\Controllers\AssetLite\BlLab;

use App\Http\Controllers\Controller;
use App\Services\BlLab\BlLabStartupStageService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;

class BlLabStartupStageController extends Controller
{
    /**
     * @var BlLabStartupStageService
     */
    private $labStartupStageService;

    /**
     * BlLabStartupStageController constructor.
     * @param BlLabStartupStageService $labStartupStageService
     */
    public function __construct(
        BlLabStartupStageService $labStartupStageService
    ) {
        $this->labStartupStageService = $labStartupStageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $items = $this->labStartupStageService->findAll();
        return view('admin.bl-lab.startup-stage.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.bl-lab.startup-stage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->labStartupStageService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/startup-stage');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->labStartupStageService->findOne($id);
        return view('admin.bl-lab.startup-stage.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->labStartupStageService->update($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/startup-stage');
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->labStartupStageService->delete($id);
        Session::flash('message', $response->getContent());
        return url('/bl-labs/startup-stage');
    }
}
