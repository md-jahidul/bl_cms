<?php

namespace App\Http\Controllers\AssetLite\BlLab;

use App\Http\Controllers\Controller;
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

class BlLabProgramController extends Controller
{
    /**
     * @var BlLabProgramService
     */
    private $blLabProgramService;

    /**
     * BlLabProgramController constructor.
     * @param BlLabProgramService $blLabProgramService
     */
    public function __construct(
        BlLabProgramService $blLabProgramService
    ) {
        $this->blLabProgramService = $blLabProgramService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $items = $this->blLabProgramService->findAll();
        return view('admin.bl-lab.program.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.bl-lab.program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->blLabProgramService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/program');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->blLabProgramService->findOne($id);
        return view('admin.bl-lab.program.edit', compact('data'));
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
        $response = $this->blLabProgramService->update($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/program');
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->blLabProgramService->delete($id);
        Session::flash('message', $response->getContent());
        return url('/bl-labs/program');
    }
}
