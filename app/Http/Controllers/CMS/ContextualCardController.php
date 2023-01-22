<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ContextualCardService;
use App\Models\Contextualcards;
use App\Http\Requests\ContextualCardRequest;

class ContextualCardController extends Controller
{

    /**
     * @var BannerService
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
    public function __construct(ContextualCardService $contextualCardService)
    {
        $this->contextualCardService = $contextualCardService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderBy = ['column' => "id", 'direction' => 'desc'];
        $contextualCards = $this->contextualCardService->findAll('', '', $orderBy);
        
        return view('admin.contextual-card.index')->with('contextualCards', $contextualCards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contextual-card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContextualCardRequest $request)
    {

        session()->flash('message', $this->contextualCardService->storeContextualCard($request->all())->getContent());
        return redirect(route('contextualcard.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contextualCard = $this->contextualCardService->findOne($id);
        return view('admin.contextual-card.show')->with('contextualCard', $contextualCard);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ContextualCards $contextualcard)
    {
        return view('admin.contextual-card.edit')->with('contextualCard', $contextualcard);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContextualCardRequest $request, $id)
    {
        session()->flash('success', $this->contextualCardService->updateContextualCard($request->all(), $id)->getContent());
        return redirect(route('contextualcard.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->contextualCardService->deleteContextualCard($id)->getContent());
        return url('contextualcard');
    }
}
