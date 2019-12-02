<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Models\ShortCut;
use App\Http\Controllers\Controller;
use App\Services\ShortCutService;
use App\Http\Requests\ShortCutUpdateRequest;
use App\Http\Requests\ShortCutStoreRequest;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.short_cuts.index')->with('short_cuts', ShortCut::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.short_cuts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShortCutStoreRequest $request)
    {
        session()->flash('message', $this->shortCutService->storeShortCut($request->all())->getContent());
        return redirect(route('short_cuts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShortCutStoreRequest $request, $id)
    {
        session()->flash('success', $this->shortCutService->updateShortCut($request->all(), $id)->getContent());
        return redirect(route('short_cuts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
        session()->flash('error', $this->shortCutService->destroyShortCut($id)->getContent());
        return url('shortcuts');
    }
}
