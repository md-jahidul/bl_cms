<?php

namespace App\Http\Controllers\CMS;

use App\Services\ContextualCardService;
use App\Services\ContextualCardIconService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContextualCardIcon;
use App\Http\Requests\ContextualCardIconRequest;

class ContextualCardIconController extends Controller
{
    /**
     * @var ContextualCardIconService
     */
    private $contextualCardIconService;

    /**
     * @var ContextualCardService
     */
    private $contextualCardService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param ContextualCardService $bannerService
     */
    public function __construct(ContextualCardService $contextualCardService,ContextualCardIconService $contextualCardIconService)
    {
        $this->contextualCardService = $contextualCardService;
        $this->contextualCardIconService = $contextualCardIconService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contextualCards=$this->contextualCardIconService->findAll();
        return view('admin.contextual-card-icon.index', compact('contextualCards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contextual-card-icon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContextualCardIconRequest $request)
    {
        session()->flash('message', $this->contextualCardIconService->storeContextualCardIcon($request->all())->getContent());
        return redirect(route('contextualcard-icons.index'));
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
        $contextualCard=ContextualCardIcon::find($id);
//        dd($contextualCard->card_number);
        return view('admin.contextual-card-icon.edit')->with('contextualCard', $contextualCard);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContextualCardIconRequest $request, $id)
    {
//        dd($request->all());
        session()->flash('success', $this->contextualCardIconService->updateContextualCard($request->all(), $id)->getContent());
        return redirect(route('contextualcard-icons.index'));
    }


}
