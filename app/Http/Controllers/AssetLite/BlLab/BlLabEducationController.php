<?php

namespace App\Http\Controllers\AssetLite\BlLab;

use App\Http\Controllers\Controller;
use App\Services\BlLab\BlLabEducationService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;

class BlLabEducationController extends Controller
{
    /**
     * @var BlLabEducationService
     */
    private $blLabEducationService;

    /**
     * BlLabEducationController constructor.
     * @param BlLabEducationService $blLabEducationService
     */
    public function __construct(
        BlLabEducationService $blLabEducationService
    ) {
        $this->blLabEducationService = $blLabEducationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = $this->blLabEducationService->findAll();
        return view('admin.bl-lab.education.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.bl-lab.education.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->blLabEducationService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/education');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->blLabEducationService->findOne($id);
        return view('admin.bl-lab.education.edit', compact('data'));
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
        $response = $this->blLabEducationService->update($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/education');
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->blLabEducationService->delete($id);
        Session::flash('message', $response->getContent());
        return url('/bl-labs/education');
    }
}
