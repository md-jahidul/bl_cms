<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\ShortCut;
use App\Http\Controllers\Controller;
use App\Services\ShortCutService;
use App\Http\Requests\ShortCutUpdateRequest;
use App\Http\Requests\ShortCutStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ShortCutController extends Controller
{

    /**
     * @var ShortCutService
     */
    private $shortCutService;

    /**
     * QuestionController constructor.
     * @param ShortCutService $shortCutService
     */
    public function __construct(ShortCutService $shortCutService)
    {
        $this->shortCutService = $shortCutService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.short_cuts.index')->with('short_cuts', ShortCut::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.short_cuts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShortCutStoreRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ShortCutStoreRequest $request)
    {
        session()->flash('message', $this->shortCutService->storeShortCut($request->all())->getContent());
        return redirect(route('short_cuts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('admin.short_cuts.index')
                    ->with('short_cuts', $this->shortCutService->findAll())
                    ->with('short_cut_info', $this->shortCutService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShortCutStoreRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(ShortCutStoreRequest $request, $id)
    {
        session()->flash('success', $this->shortCutService->updateShortCut($request->all(), $id)->getContent());
        return redirect(route('short_cuts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        //return $id;
        session()->flash('error', $this->shortCutService->destroyShortCut($id)->getContent());
        return url('shortcuts');
    }
}
