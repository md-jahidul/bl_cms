<?php

namespace App\Http\Controllers\AssetLite\BlLab;

use App\Http\Controllers\Controller;
use App\Services\BlLab\BlLabInstituteOrgService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;

class BlLabInstituteOrgController extends Controller
{
    /**
     * @var BlLabInstituteOrgService
     */
    private $labInstituteOrgService;

    /**
     * BlLabInstituteOrgController constructor.
     * @param BlLabInstituteOrgService $labInstituteOrgService
     */
    public function __construct(
        BlLabInstituteOrgService $labInstituteOrgService
    ) {
        $this->labInstituteOrgService = $labInstituteOrgService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = $this->labInstituteOrgService->findAll();
        return view('admin.bl-lab.institute-org.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.bl-lab.institute-org.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->labInstituteOrgService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/institute-or-org');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->labInstituteOrgService->findOne($id);
        return view('admin.bl-lab.institute-org.edit', compact('data'));
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
        $response = $this->labInstituteOrgService->update($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/bl-labs/institute-or-org');
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->labInstituteOrgService->delete($id);
        Session::flash('message', $response->getContent());
        return url('/bl-labs/institute-or-org');
    }
}
