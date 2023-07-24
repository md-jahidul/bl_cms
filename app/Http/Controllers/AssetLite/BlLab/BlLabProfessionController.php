<?php

namespace App\Http\Controllers\AssetLite\BlLab;

use App\Http\Controllers\Controller;
use App\Services\BlLab\BlLabProfessionService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;

class BlLabProfessionController extends Controller
{
    /**
     * @var BlLabProfessionService
     */
    private $blLabProfessionService;

    /**
     * BlLabProfessionController constructor.
     * @param BlLabProfessionService $blLabProfessionService
     */
    public function __construct(
        BlLabProfessionService $blLabProfessionService
    ) {
        $this->blLabProfessionService = $blLabProfessionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = $this->blLabProfessionService->findAll();
        return view('admin.bl-lab.profession.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.bl-lab.profession.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->blLabProfessionService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/profession');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->blLabProfessionService->findOne($id);
        return view('admin.bl-lab.profession.edit', compact('data'));
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
        $response = $this->blLabProfessionService->update($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/profession');
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->blLabProfessionService->delete($id);
        Session::flash('message', $response->getContent());
        return url('/bl-labs/profession');
    }
}
